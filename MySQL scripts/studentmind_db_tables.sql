-- Database name: studentmind_db
-- Database username: admin
-- Password: hDo<{v->4\l$npU!
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

/*
	Creating tables and assigning necessary datatypes and constraint to the required fields.
	Join table are included that normalise many to many relationships.
*/

-- The address tables is useful for organizing and storing address-related information, which can be used to minimise data repetition in the database.
CREATE TABLE `tbl_Addresses` (
  `address_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL, -- UNSIGNED INT assigned as we aim to hold the same max number of addresses as there are users.
  `line1` VARCHAR(128) NOT NULL,
  `line2` VARCHAR(128) NOT NULL,
  `post_code` VARCHAR(12) NOT NULL,
  `city_town` VARCHAR(128) NOT NULL,
  `country` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`address_ID`)
);

-- The user table stores data about the user except for the address which is related to the user through a join table.
CREATE TABLE `tbl_Users` (
    `user_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL, -- UNSIGNED INT assigned as we do not aim for more than 4,294,967,295 users.
    `givenName` VARCHAR(64) NOT NULL,
	`middleName` VARCHAR(64) DEFAULT NULL,
	`familyName` VARCHAR(64) NOT NULL,
	`gender` VARCHAR(40) NOT NULL,
	`dob` DATE NOT NULL, -- Date of birth field cannot be empty for any user. Validation has to be made to ensure the user is over 16 years of age.
	`email` VARCHAR(256) NOT NULL, -- The current standard limits the total length of an email address to 256 characters, including punctuation.
	`mob_num` VARCHAR(16) NOT NULL, -- This field is using the E.164 format for full international support. Format should be done on the client side.
	`bio_desc` VARCHAR(256) DEFAULT NULL, -- This field would store the user's personal description and be shown in the profile page.
	`password_hash` VARCHAR(256) NOT NULL,
	`password_count` INT DEFAULT 0 NOT NULL, -- Used to store data about how many times the password has been wrongly inserted. Function check done from the client side.
    `is_minor` BOOLEAN DEFAULT 0 NOT NULL, /* This field works as a flag that would be set to 'true' or (1) when the `user_is_minor` trigger alerts the database.
    if a user is registered having less than 16 years old or with a future date.*/
    PRIMARY KEY (`user_ID`)
);

-- Ensuring that no two records in the `tbl_Users` table can have the same email address, requirement for user authentication and management systems.
CREATE UNIQUE INDEX index_unique_tbl_Users_email ON `tbl_Users` (email);

DELIMITER $$
-- The trigger syntax works best for MySQL not so much for server version 10.5.16-MariaDB.
CREATE TRIGGER `user_is_minor` BEFORE INSERT ON `tbl_Users`
-- Trigger will run before each insert on the "tbl_Users" table.
FOR EACH ROW BEGIN
	IF New.dob < DATE_SUB(CURDATE(), INTERVAL 16 YEAR) AND New.dob > CURDATE() THEN -- Check if the value of the "dob" column being inserted is less than the current date minus 16 years and if it is a future date.
		SET New.dob = CURDATE(); -- If so, set the value of the "dob" column being inserted to the current date.
		SET New.is_minor = 1; -- Set the value of the "is_minor" column being inserted to 1.
	END IF;
END$$
DELIMITER ;

-- Educations table used to store data regarding the users educational background.
CREATE TABLE `tbl_Educations` (
    `education_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `institutionName` VARCHAR(128) NOT NULL,
    `courseTitle` VARCHAR(128) NOT NULL,
    `date_start` DATE NOT NULL,
    `date_end` DATE DEFAULT NULL,
    `is_ongoing` BOOLEAN DEFAULT NULL,
    PRIMARY KEY (`education_ID`)
);

-- Projects table used to store data about projects that users were part of.
CREATE TABLE `tbl_Projects` (
    `project_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `projectName` VARCHAR(128) NOT NULL,
    `projectDesc` VARCHAR(256) DEFAULT NULL,
    `date_end` DATE DEFAULT NULL,
    `is_ongoing` BOOLEAN DEFAULT NULL, /* If from the client side a user selects that a project is ongoing than this table is set as true (1) and `date_end` field is set as NULL.
										  If the user sets a value for `date_end` than the field `is_ongoing` is set as NULL.*/
    PRIMARY KEY (`project_ID`)
);

/*
	Trigger that checks if the value of the field `is_ongoing` for the new row being inserted is false.
	If yes then the `date_end` field for the new row will be set to the new value being inserted (if provided) 
	or the current date and time (using the NOW() function) if no value is provided. The IFNULL function is used to handle the case where no value is provided for date_end.
*/
DELIMITER $$
CREATE TRIGGER `project_is_ongoing` BEFORE INSERT ON `tbl_Projects`
FOR EACH ROW
BEGIN
    IF NEW.is_ongoing = TRUE THEN
        SET NEW.date_end = NULL;
    ELSE
        SET NEW.date_end = IFNULL(NEW.date_end, NOW());
    END IF;
END$$
DELIMITER ;

-- Join table that connects users to projects. Therefore, allows multiple users to be part of the same project and aids in data repetition.
CREATE TABLE `tbl_Users_Projects` (
    `user_ID_pk_fk` INT UNSIGNED NOT NULL,
    `project_ID_pk_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_ID_pk_fk`, `project_ID_pk_fk`),
    FOREIGN KEY (`project_ID_pk_fk`) REFERENCES `tbl_Projects`(`project_ID`),
    FOREIGN KEY (`user_ID_pk_fk`) REFERENCES `tbl_Users`(`user_ID`)
);

-- To find rows with specific column values quiclky, required for user management systems.
CREATE INDEX index_tbl_Users_Projects_project_ID ON `tbl_Users_Projects` (project_ID_pk_fk);

-- Posts table is used to store data about a post made from a particular user.
CREATE TABLE `tbl_Posts` (
    `post_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `content_txt` VARCHAR(256) NOT NULL,
    `post_date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `postOwner_ID_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`post_ID`),
    FOREIGN KEY (`postOwner_ID_fk`) REFERENCES `tbl_Users`(`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE -- This will delete the post and everythinh it contains if the user account is deleted.
);

-- To find rows with specific column values quiclky, required for user management systems.
CREATE INDEX index_tbl_Posts_postOwner_ID_fk ON `tbl_Posts` (postOwner_ID_fk);

/* 
	No trigger needed that sets a timestamp for the field `post_date_created` on each record before every input.
    The data field does that automatically.
*/

-- Comments table that stores data about the comment made from a specific user posted on a specific post.
CREATE TABLE `tbl_Comments` (
    `comment_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `content_txt` VARCHAR(256) NOT NULL,
    `comment_date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `commentOwner_ID_fk` INT UNSIGNED NOT NULL,
    `post_ID_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`comment_ID`),
    FOREIGN KEY (`commentOwner_ID_fk`) REFERENCES `tbl_Users`(`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE, -- This will delete the comment record if the user account is deleted.
    FOREIGN KEY (`post_ID_fk`) REFERENCES `tbl_Posts`(`post_ID`) ON DELETE CASCADE ON UPDATE CASCADE -- This will delete the comment record if the post is deleted.
);

-- To find rows with specific column values quiclky, required for user management systems.
CREATE INDEX index_tbl_Comments_commentOwner_ID_fk ON `tbl_Comments` (commentOwner_ID_fk);
CREATE INDEX index_tbl_Comments_post_ID_fk ON `tbl_Comments` (post_ID_fk);

/* 
	No trigger needed that sets a timestamp for the field `comment_date_created` on each record before every input.
    The data field does that automatically.
*/

-- In Sprint 2 to be added: Possibility to store images in the posts and comments tables, as well as the users table.