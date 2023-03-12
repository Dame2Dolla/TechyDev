-- Statements to be used by the software developer:

-- Process for inserting user's data:
-- 1. Insert the address:
INSERT INTO `tbl_Address` (`line1`, `line2`, `post_code`, `city_town`, `country`) 
VALUES ('123 Main Street', 'Apt 4B', '12345', 'Anytown', 'USA');

-- 2. Insert the user:
INSERT INTO tbl_Users (givenName, middleName, familyName, gender, dob, email, mob_num, bio_desc, password) 
VALUES ('John', 'Smith', 'Doe', 'Male', '1990-05-15', 'john.smith@example.com', '+1-555-123-4567', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- 3. Insert the user_address relation:
INSERT INTO `tbl_Address_Users` (`fk_address_id`, `fk_user_id`) 
VALUES (1, 1);