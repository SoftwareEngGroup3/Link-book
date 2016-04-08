CREATE TABLE Users
(
ulDnum INT,
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
PRIMARY KEY (ulDnum)
);

CREATE TABLE Statuses
(
statid INT,
ulDnum INT,
content TEXT,
PRIMARY KEY (statid),
FOREIGN KEY (ulDnum) REFERENCES Users(ulDnum)
);

CREATE TABLE `Profile`
(
prolDnum INT,
proOwner VARCHAR(30),
summery TEXT,
code_links VARCHAR(60),
project_screenshots VARCHAR(30),
PRIMARY KEY (prolDnum)
);

CREATE TABLE Buisness
(
ulDnum INT,
blDnum INT,
name VARCHAR(30),
contact_email VARCHAR(30),
contact_name VARCHAR(30),
size INT,
product VARCHAR(30),
openings INT,
photo VARCHAR(30),
PRIMARY KEY (ulDnum, blDnum),
FOREIGN KEY (ulDnum) REFERENCES Users(ulDnum)
);

CREATE TABLE Listing
(
blDnum INT,
job_title VARCHAR(30),
job_description VARCHAR(600),
qualifications VARCHAR(600),
starting_pay VARCHAR(30),
PRIMARY KEY (blDnum)
);

CREATE TABLE Messages
(
msglDnum INT,
send_timestamp TIMESTAMP,
sender_ulDnum INT,
receiver_ulDnum INT,
receiver_timestamp TIMESTAMP,
contents TEXT,
PRIMARY KEY (msglDnum)
);