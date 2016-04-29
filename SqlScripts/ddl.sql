-- Get rid of old data
DROP TABLE IF EXISTS linkbook.gen_users;
DROP TABLE IF EXISTS linkbook.statuses;
DROP TABLE IF EXISTS linkbook.profiles;
DROP TABLE IF EXISTS linkbook.buisness;
DROP TABLE IF EXISTS linkbook.listing;
DROP TABLE IF EXISTS linkbook.messages;
DROP TABLE IF EXISTS linkbook.job_history;
DROP TABLE IF EXISTS linkbook.education;
DROP TABLE IF EXISTS linkbook.volunteer_work;
DROP TABLE IF EXISTS linkbook.connections;

DROP SCHEMA IF EXISTS linkbook;
CREATE SCHEMA linkbook;


CREATE TABLE linkbook.gen_users
(
uIDnum INT,
fName VARCHAR(30),
lName VARCHAR(30),
email VARCHAR(20),
Orginization VARCHAR(30),
Bio TEXT,
job_history TEXT,
Education VARCHAR(30),
profile_picture VARCHAR(50),
volunteer_work TEXT,
coding_languages VARCHAR(60),
PRIMARY KEY (uIDnum)
);

CREATE TABLE  linkbook.statuses
(
statID INT,
uIDnum INT,
content TEXT,
PRIMARY KEY (statid),
FOREIGN KEY (uIDnum) REFERENCES linkbook.gen_users(uIDnum)
);

CREATE TABLE  linkbook.profiles
(
proIDnum INT,
proOwner VARCHAR(30),
summery TEXT,
code_links VARCHAR(60),
project_screenshots VARCHAR(30),
PRIMARY KEY (proIDnum)
);

CREATE TABLE  linkbook.buisness
(
uIDnum INT,
bIDnum INT,
name VARCHAR(30),
contact_email VARCHAR(30),
contact_name VARCHAR(30),
size INT,
product VARCHAR(30),
openings INT,
photo VARCHAR(30),
PRIMARY KEY (uIDnum, bIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.gen_users(uIDnum)
);

CREATE TABLE  linkbook.listing
(
bIDnum INT,
job_title VARCHAR(30),
job_description VARCHAR(600),
qualifications VARCHAR(600),
starting_pay VARCHAR(30),
PRIMARY KEY (bIDnum)
);

CREATE TABLE  linkbook.messages
(
msgIDnum INT,
send_timestamp TIMESTAMP,
sender_uIDnum INT,
receiver_uIDnum INT,
receiver_timestamp TIMESTAMP,
contents TEXT,
PRIMARY KEY (msgIDnum),
FOREIGN KEY (sender_uIDnum) REFERENCES linkbook.gen_users(uIDnum),
FOREIGN KEY (receiver_uIDnum) REFERENCES linkbook.gen_users(uIDnum),
);