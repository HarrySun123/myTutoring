CREATE TABLE Users(
user_id varchar(10) NOT NULL,
user_name varchar(255) NOT NULL,
user_password varchar(255) NOT NULL,
user_year varchar(10)  NULL,
user_email varchar(255) NOT NULL,
user_phone varchar(30) NULL,
user_role varchar(255) NOT NULL,
user_tutor_group varchar(255) NOT NULL
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
additional_info varchar(1000) NOT NULL,
status varchar(10) NOT NULL,
feedback varchar(1000) NOT NULL,
);


INSERT INTO `users`(`user_id`, `user_name`, `user_password`, `user_year`, `user_email`, `user_phone`, `user_role`, `user_tutor_group`) 
VALUES ('23592','Harry Sun','harry123','11','23592@redeemer.com.au','0490125577','mentor','LO6');

INSERT INTO `users`(`user_id`, `user_name`, `user_password`, `user_year`, `user_email`, `user_phone`, `user_role`, `user_tutor_group`) 
VALUES ('156','Phillip Baskerville','baskerville123','','pbaskerville@redeemer.com.au','','teacher','');

INSERT INTO `users`(`user_id`, `user_name`, `user_password`,`user_year`, `user_email`, `user_phone`, `user_role`, `user_tutor_group`) 
VALUES ('15166','William Lee','wiyum123','11','15166@redeemer.com.au','','mentee','WO4');







