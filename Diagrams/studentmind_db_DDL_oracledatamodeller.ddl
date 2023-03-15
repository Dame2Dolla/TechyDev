-- Generated by Oracle SQL Developer Data Modeler 19.4.0.350.1424
--   at:        2023-03-15 19:47:38 CET
--   site:      Oracle Database 11g
--   type:      Oracle Database 11g



CREATE TABLE tbl_addresses (
    address_id  INTEGER NOT NULL,
    line1       VARCHAR2(128) NOT NULL,
    line2       VARCHAR2(128) NOT NULL,
    post_code   VARCHAR2(12) NOT NULL,
    city_town   VARCHAR2(128) NOT NULL,
    country     VARCHAR2(64) NOT NULL
);

ALTER TABLE tbl_addresses ADD CONSTRAINT tbl_addresses_pk PRIMARY KEY ( address_id );

CREATE TABLE tbl_comments (
    comment_id            INTEGER NOT NULL,
    content_txt           VARCHAR2(256) NOT NULL,
    comment_date_created  TIMESTAMP,
    tbl_users_user_id     INTEGER NOT NULL,
    tbl_posts_post_id     INTEGER NOT NULL
);

ALTER TABLE tbl_comments ADD CONSTRAINT tbl_comments_pk PRIMARY KEY ( comment_id );


--  ERROR: UK name length exceeds maximum allowed length(30) 

ALTER TABLE tbl_comments ADD CONSTRAINT tbl_comments_tbl_users_user_id_un UNIQUE ( tbl_users_user_id );


--  ERROR: UK name length exceeds maximum allowed length(30) 

ALTER TABLE tbl_comments ADD CONSTRAINT tbl_comments_tbl_posts_post_id_un UNIQUE ( tbl_posts_post_id );

CREATE TABLE tbl_educations (
    education_id     INTEGER NOT NULL,
    institutionname  VARCHAR2(128) NOT NULL,
    coursetitle      VARCHAR2(128) NOT NULL,
    date_start       DATE NOT NULL,
    date_end         DATE,
    is_ongoing       CHAR(1)
);

ALTER TABLE tbl_educations ADD CONSTRAINT tbl_educations_pk PRIMARY KEY ( education_id );

CREATE TABLE tbl_posts (
    post_id            INTEGER NOT NULL,
    content_txt        VARCHAR2(256) NOT NULL,
    post_date_created  TIMESTAMP,
    tbl_users_user_id  INTEGER NOT NULL
);

ALTER TABLE tbl_posts ADD CONSTRAINT tbl_posts_pk PRIMARY KEY ( post_id );

ALTER TABLE tbl_posts ADD CONSTRAINT tbl_posts_tbl_users_user_id_un UNIQUE ( tbl_users_user_id );

CREATE TABLE tbl_projects (
    project_id   INTEGER NOT NULL,
    projectname  VARCHAR2(128) NOT NULL,
    projectdesc  VARCHAR2(256),
    is_ongoing   CHAR(1)
);

ALTER TABLE tbl_projects ADD CONSTRAINT tbl_projects_pk PRIMARY KEY ( project_id );

CREATE TABLE tbl_users (
    user_id                   INTEGER NOT NULL,
    givenname                 VARCHAR2(64) NOT NULL,
    middlename                VARCHAR2(64),
    familyname                VARCHAR2(64) NOT NULL,
    gender                    VARCHAR2(40) NOT NULL,
    dob                       DATE NOT NULL,
    email                     VARCHAR2(256) NOT NULL,
    mob_num                   VARCHAR2(16) NOT NULL,
    bio_desc                  VARCHAR2(256),
    password_hash             VARCHAR2(256) NOT NULL,
    password_count            INTEGER,
    is_minor                  CHAR(1) NOT NULL,
    tbl_addresses_address_id  INTEGER NOT NULL
);

ALTER TABLE tbl_users ADD CONSTRAINT tbl_users_pk PRIMARY KEY ( user_id );

ALTER TABLE tbl_users ADD CONSTRAINT tbl_users_email_un UNIQUE ( email );

CREATE TABLE tbl_users_educations (
    tbl_users_user_id            INTEGER NOT NULL,
    tbl_educations_education_id  INTEGER NOT NULL
);

ALTER TABLE tbl_users_educations ADD CONSTRAINT tbl_users_educations_pk PRIMARY KEY ( tbl_users_user_id,
                                                                                      tbl_educations_education_id );


--  ERROR: UK name length exceeds maximum allowed length(30) 

ALTER TABLE tbl_users_educations ADD CONSTRAINT tbl_users_educations_tbl_educations_education_id_un UNIQUE ( tbl_educations_education_id );

CREATE TABLE tbl_users_projects (
    tbl_users_user_id        INTEGER NOT NULL,
    tbl_projects_project_id  INTEGER NOT NULL
);

ALTER TABLE tbl_users_projects ADD CONSTRAINT tbl_users_projects_pk PRIMARY KEY ( tbl_users_user_id,
                                                                                  tbl_projects_project_id );


--  ERROR: UK name length exceeds maximum allowed length(30) 

ALTER TABLE tbl_users_projects ADD CONSTRAINT tbl_users_projects_tbl_projects_project_id_un UNIQUE ( tbl_projects_project_id );

ALTER TABLE tbl_comments
    ADD CONSTRAINT tbl_comments_tbl_posts_fk FOREIGN KEY ( tbl_posts_post_id )
        REFERENCES tbl_posts ( post_id );

ALTER TABLE tbl_comments
    ADD CONSTRAINT tbl_comments_tbl_users_fk FOREIGN KEY ( tbl_users_user_id )
        REFERENCES tbl_users ( user_id );

ALTER TABLE tbl_posts
    ADD CONSTRAINT tbl_posts_tbl_users_fk FOREIGN KEY ( tbl_users_user_id )
        REFERENCES tbl_users ( user_id );

--  ERROR: FK name length exceeds maximum allowed length(30) 
ALTER TABLE tbl_users_educations
    ADD CONSTRAINT tbl_users_educations_tbl_educations_fk FOREIGN KEY ( tbl_educations_education_id )
        REFERENCES tbl_educations ( education_id );

--  ERROR: FK name length exceeds maximum allowed length(30) 
ALTER TABLE tbl_users_educations
    ADD CONSTRAINT tbl_users_educations_tbl_users_fk FOREIGN KEY ( tbl_users_user_id )
        REFERENCES tbl_users ( user_id );

--  ERROR: FK name length exceeds maximum allowed length(30) 
ALTER TABLE tbl_users_projects
    ADD CONSTRAINT tbl_users_projects_tbl_projects_fk FOREIGN KEY ( tbl_projects_project_id )
        REFERENCES tbl_projects ( project_id );

--  ERROR: FK name length exceeds maximum allowed length(30) 
ALTER TABLE tbl_users_projects
    ADD CONSTRAINT tbl_users_projects_tbl_users_fk FOREIGN KEY ( tbl_users_user_id )
        REFERENCES tbl_users ( user_id );

ALTER TABLE tbl_users
    ADD CONSTRAINT tbl_users_tbl_addresses_fk FOREIGN KEY ( tbl_addresses_address_id )
        REFERENCES tbl_addresses ( address_id );



-- Oracle SQL Developer Data Modeler Summary Report: 
-- 
-- CREATE TABLE                             8
-- CREATE INDEX                             0
-- ALTER TABLE                             22
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   8
-- WARNINGS                                 0
