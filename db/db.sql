CREATE TABLE Users(
user_id varchar(10) NOT NULL,
user_name varchar(255) NOT NULL,
user_year varchar(10) NOT NULL,
user_email varchar(255) NOT NULL,
user_phone varchar(30) NOT NULL,
user_role varchar(255) NOT NULL,
user_tutor_group varchar(255) NOT NULL,
);


CREATE TABLE Sessions(
session_id varchar(20) NOT NULL,
mentor_id varchar(10) NOT NULL,
mentee_id varchar(10) NULL,
mentor_year varchar(10) NOT NULL,
mentee_year varchar(10) NULL,
subject varchar(255) NOT NULL,
time varchar(255) NOT NULL,
location varchar(255) NULL,
status varchar(10) NOT NULL,
feedback varchar(1000) NOT NULL,
);

INSERT INTO `users`(`user_id`, `user_name`, `user_year`, `user_email`, `user_phone`, `user_role`, `user_tutor_group`) 
VALUES ('156','Phillip Baskerville','','pbaskerville@redeemer.com.au','','teacher','');