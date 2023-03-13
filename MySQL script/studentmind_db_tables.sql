-- Database name: studentmind_db
-- Database username: admin
-- Password: hDo<{v->4\l$npU!
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

-- Creating the address table and assigning necessary datatypes and constraint to the required fields.
-- The address tables is useful for organizing and storing address-related information, which can be used to minimise data repetition in the database.
CREATE TABLE `tbl_Addresses` (
  `address_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL, -- UNSIGNED INT assigned as we aim to hold the same max number of addresses as there are users.
  `line1` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
  `line2` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
  `city_town` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
  `country` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_ID`)
);

-- Creating the users table and assigning necessary datatypes and constraint to the required fields
CREATE TABLE `tbl_Users` (
    `user_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL, -- UNSIGNED INT assigned as we do not aim for more than 4,294,967,295 users.
    `givenName` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL,
	`middleName` VARCHAR(64) COLLATE utf8_unicode_ci DEFAULT NULL,
	`familyName` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL,
	`gender` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
	`dob` DATE NOT NULL,
	`email` VARCHAR(80) COLLATE utf8_unicode_ci NOT NULL,
	`mob_num` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
	`bio_desc` VARCHAR(254) COLLATE utf8_unicode_ci DEFAULT NULL, -- This field would store the user's personal description and be shown in the profile page.
	`password_hash` VARCHAR(256) COLLATE utf8_unicode_ci NOT NULL,
	`password_count` INT(1) DEFAULT 0 NOT NULL, 
    `is_minor` BOOLEAN DEFAULT 0 NOT NULL, /* This field works as a flag that would be set to 'true' or (1) when the `user_is_minor` trigger alerts the database 
    if a user is registered having less than 16 years old or with a future date.*/
    PRIMARY KEY (`user_ID`)
);
	-- Encrypting password whith NSA method SHA() with 256 characters. Left commented so it can be discussed for Sprint 2 with Software Developer and Security analyst.
	-- CREATE TRIGGER `hash_password` BEFORE INSERT ON `tbl_Users`
	-- FOR EACH ROW SET NEW.password = SHA2(NEW.password, 256);
    
    -- Ensuring that no two records in the `tbl_Users` table can have the same email address, requirement for user authentication and management systems.
	CREATE UNIQUE INDEX index_tbl_Users_email ON `tbl_Users` (email);
    
 /* The trigger is commented because it works only for phpMyAdmin server version 10.5.16-MariaDB
 
    CREATE TRIGGER `user_is_minor` BEFORE INSERT ON `tbl_Users`
	-- Create a trigger named "user_is_minor" that will run before each insert on the "tbl_Users" table.
	FOR EACH ROW BEGIN
		IF New.dob < DATE_SUB(CURDATE(), INTERVAL 16 YEAR) AND New.dob > CURDATE() THEN
		-- Check if the value of the "dob" column being inserted is less than the current date minus 16 years
		-- and if it is a future date.
			SET New.dob = CURDATE();
			-- If so, set the value of the "dob" column being inserted to the current date.
			SET New.is_minor = 1;
			-- Set the value of the "is_minor" column being inserted to 1.
		END IF;
	-- End the if statement.
	END
	-- End the trigger code block.
*/

-- Creating a join table for the tbl_Address and tbl_Users, that would cater for multiple users using the same address. Example: family members.
CREATE TABLE `tbl_Users_Addresses` (
    `user_ID_pk_fk` INT UNSIGNED NOT NULL,
    `address_ID_pk_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_ID_pk_fk`, `address_ID_pk_fk`),
    FOREIGN KEY (`address_ID_pk_fk`) REFERENCES `tbl_Addresses`(`address_ID`),
    FOREIGN KEY (`user_ID_pk_fk`) REFERENCES `tbl_Users`(`user_ID`)
);

-- Creating the educations table and assigning necessary datatypes and constraint to the required fields
CREATE TABLE `tbl_Educations` (
    `education_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `institutionName` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
    `courseName` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
    `date_start` DATE NOT NULL,
    `date_end` DATE DEFAULT NULL,
    `is_ongoing` BOOLEAN DEFAULT NULL,
    PRIMARY KEY (`education_ID`)
);

-- Creating a join table for the tbl_Educations and tbl_Users, that would cater for multiple users using the educational background. Example: Students in the same classs at university
CREATE TABLE `tbl_Users_Educations` (
    `user_ID_pk_fk` INT UNSIGNED NOT NULL,
    `educaton_ID_pk_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_ID_pk_fk`, `education_ID_pk_fk`),
    FOREIGN KEY (`education_ID_pk_fk`) REFERENCES `tbl_Educations`(`education_ID`),
    FOREIGN KEY (`user_ID_pk_fk`) REFERENCES `tbl_Users`(`user_ID`)
);

-- Creating the projects table and assigning necessary datatypes and constraint to the required fields
CREATE TABLE `tbl_Projects` (
    `project_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `projectName` VARCHAR(128) COLLATE utf8_unicode_ci NOT NULL,
    `projectDesc` VARCHAR(254) COLLATE utf8_unicode_ci DEFAULT NULL,
    `date_end` DATE DEFAULT NULL,
    `is_ongoing` BOOLEAN DEFAULT NULL,
    PRIMARY KEY (`project_ID`)
);

-- Creating a join table for the tbl_Projects and tbl_Users, that would cater for multiple users being part of the same project. Example: Colaborators in a project.
CREATE TABLE `tbl_Users_Projects` (
    `user_ID_pk_fk` INT UNSIGNED NOT NULL,
    `project_ID_pk_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_ID_pk_fk`, `project_ID_pk_fk`),
    FOREIGN KEY (`project_ID_pk_fk`) REFERENCES `tbl_Projects`(`project_ID`),
    FOREIGN KEY (`user_ID_pk_fk`) REFERENCES `tbl_Users`(`user_ID`)
);

-- Creating the posts table and assigning necessary datatypes and constraint to the required fields
CREATE TABLE `tbl_Posts` (
    `post_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `content_txt` VARCHAR(254) COLLATE utf8_unicode_ci NOT NULL,
    `date_created` DATE DEFAULT NULL,
    PRIMARY KEY (`post_ID`)
);

-- add triggers for the posts table

-- Creating the comments table and assigning necessary datatypes and constraint to the required fields
CREATE TABLE `tbl_Comments` (
    `comment_ID` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `content_txt` VARCHAR(254) COLLATE utf8_unicode_ci NOT NULL,
    `date_created` DATE DEFAULT NULL,
    PRIMARY KEY (`comment_ID`)
);

-- create trigger on input to set date as now()
-- Creating a join table for the tbl_Projects. tbl_Users and tbl_Comments, that would cater for multiple comments being added to a post and multiple users having multiple comments and mutiple posts being post by the same user.
CREATE TABLE `tbl_Posts_Users_Comments` (
    `post_ID_pk_fk` INT UNSIGNED NOT NULL,
    `user_ID_pk_fk` INT UNSIGNED NOT NULL,
    `comment_ID_pk_fk` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`comment_ID_pk_fk`, `user_ID_pk_fk`, `post_ID_pk_fk`),
    FOREIGN KEY (`post_ID_pk_fk`) REFERENCES `tbl_Posts`(`post_ID`),
    FOREIGN KEY (`user_ID_pk_fk`) REFERENCES `tbl_Users`(`user_ID`),
    FOREIGN KEY (`comment_ID_pk_fk`) REFERENCES `tbl_Comments`(`comment_ID`)
);



-- In Sprint 2 to be added: tables and security elements.
-- In Sprint 2 to be modified: ...