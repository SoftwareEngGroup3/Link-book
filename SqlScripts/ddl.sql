DROP TABLE IF EXISTS linkbook.statuses;
DROP TABLE IF EXISTS linkbook.profile;
DROP TABLE IF EXISTS linkbook.buisness;
DROP TABLE IF EXISTS linkbook.listing;
DROP TABLE IF EXISTS linkbook.messages;
DROP TABLE IF EXISTS linkbook.job_history;
DROP TABLE IF EXISTS linkbook.education;
DROP TABLE IF EXISTS linkbook.vol_work;
DROP TABLE IF EXISTS linkbook.connections;

DROP SCHEMA IF EXISTS linkbook;
CREATE SCHEMA linkbook;


CREATE TABLE linkbook.users
(
uIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
fName VARCHAR(30),
lName VARCHAR(30),
email VARCHAR(20),
username VARCHAR(50),
salt CHAR(40) NOT NULL,
hashed_pass CHAR(255) NOT NULL,
orginization VARCHAR(30),
bio TEXT,
profile_picture VARCHAR(50),
coding_languages VARCHAR(60)
-- PRIMARY KEY (uIDnum)
);

CREATE TABLE linkbook.connections
(
conIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
uIDnum1 INT,
uIDnum2 INT
-- PRIMARY KEY (conIDnum),
-- FOREIGN KEY (uIDnum1) REFERENCES linkbook.users(uIDnum),
-- FOREIGN KEY (uIDnum2) REFERENCES linkbook.users(uIDnum)
);

CREATE TABLE linkbook.statuses
(
uIDnum INT,
statIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
ulDnum INT,
content TEXT,
-- PRIMARY KEY (statIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);

CREATE TABLE linkbook.profile
(
proIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
uIDnum INT,
summery TEXT,
code_links VARCHAR(60),
project_screenshots VARCHAR(30),
-- PRIMARY KEY (proIDnum,uIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);

CREATE TABLE linkbook.business
(
uIDnum INT,
bIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(30),
contact_email VARCHAR(30),
contact_name VARCHAR(30),
biz_size INT,
product VARCHAR(30),
openings INT,
photo VARCHAR(30),
-- PRIMARY KEY (uIDnum, bIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);

CREATE INDEX ix_bIDnum ON linkbook.business(bIDnum);

CREATE TABLE linkbook.listing
(
listIDnum INT NOT NULL AUTO_INCREMENT,
bIDnum INT,
job_title VARCHAR(30),
job_description VARCHAR(600),
qualifications VARCHAR(600),
starting_pay VARCHAR(30),
PRIMARY KEY (listIDnum, bIDnum),
FOREIGN KEY (bIDnum) REFERENCES linkbook.business(bIDnum)
);

CREATE TABLE linkbook.messages
(
msgIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
send_timestamp TIMESTAMP,
sender_uIDnum INT,
receiver_uIDnum INT,
receiver_timestamp TIMESTAMP,
contents TEXT
-- PRIMARY KEY (msgIDnum)
/*
FOREIGN KEY (sender_uIDnum) REFERENCES linkbook.users(uIDnum),
FOREIGN KEY (receiver_uIDnum) REFERENCES linkbook.users(uIDnum)
*/
);


CREATE TABLE linkbook.education
(
uIDnum INT,
eduIDnum INT NOT NULL AUTO_INCREMENT,
institution TEXT,
degree TEXT,
PRIMARY KEY (eduIDnum, uIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);

CREATE TABLE linkbook.job_history
(
uIDnum INT,
jobIDnum INT NOT NULL AUTO_INCREMENT,
company VARCHAR(100),
job_title VARCHAR(100),
PRIMARY KEY (jobIDnum, uIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);

CREATE TABLE linkbook.vol_work
(
uIDnum INT,
volIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
orginization VARCHAR(100),
position VARCHAR(100),
-- PRIMARY KEY (uIDnum, volIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);