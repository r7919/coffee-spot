-- coffee 

DROP TABLE IF EXISTS coffee;
CREATE TABLE coffee (
  coffee_id int NOT NULL AUTO_INCREMENT,
  coffee_name varchar(255) NOT NULL,
  coffee_price int NOT NULL,
  cook_time int NOT NULL,
  trend_val int NOT NULL,
  PRIMARY KEY (coffee_id)
);

INSERT INTO coffee (coffee_id, coffee_name, coffee_price, cook_time, trend_val) VALUES (1, 'Espresso', 225, 5, 1);
INSERT INTO coffee (coffee_id, coffee_name, coffee_price, cook_time, trend_val) VALUES (2, 'Macchiato', 120, 4, 1);
INSERT INTO coffee (coffee_id, coffee_name, coffee_price, cook_time, trend_val) VALUES (3, 'Mocha', 110, 5, 1);
INSERT INTO coffee (coffee_id, coffee_name, coffee_price, cook_time, trend_val) VALUES (4, 'Java Chip', 130, 7, 1);

-- admins

DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
  id int NOT NULL AUTO_INCREMENT,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  hashed_password varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY index_username (username)
);

INSERT INTO admins VALUES (1,'ubc','admin','ubc@admin.com','ubc','$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi');

-- users

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(255) DEFAULT NULL,
  hashed_password varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY index_username (username)
);

INSERT INTO users VALUES (1, 'user', '$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi');




