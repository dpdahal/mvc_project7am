CREATE TABLE tbl_users(
id int unsigned AUTO_INCREMENT PRIMARY KEY,
name varchar(100) not null,
username varchar(100) UNIQUE,
email varchar(100) UNIQUE,
user_type ENUM ('user','admin') DEFAULT 'user',
status int DEFAULT 0,
image varchar(100) not null,
password varchar(100)

);

CREATE TABLE tbl_image_category(
id int unsigned AUTO_INCREMENT PRIMARY KEY,
cat_name varchar(100)

);

CREATE TABLE tbl_slider(
id int unsigned AUTO_INCREMENT PRIMARY KEY,
title varchar(200),
image varchar(100),
description text

);