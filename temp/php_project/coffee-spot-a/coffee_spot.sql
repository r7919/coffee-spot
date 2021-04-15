-- coffee 

DROP TABLE IF EXISTS coffee;
CREATE TABLE coffee (
  coffee_id int NOT NULL AUTO_INCREMENT,
  coffee_name varchar(255) NOT NULL,
  coffee_price int NOT NULL,
  cook_time int NOT NULL,
  trend_val int NOT NULL,
  PRIMARY KEY (coffee_id),
  KEY index_coffee_name (coffee_name)
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

-- employees

DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
  id int NOT NULL AUTO_INCREMENT,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  hashed_password varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY index_username (username)
);

INSERT INTO employees VALUES (1,'elliot','employee','elliot@employee.com','elliot','$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi');

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
INSERT INTO users VALUES (2, 'spiderman', '$2y$10$BaM/Nu5JZIBg3rqFtdJCtOaDW8NR0XfhuJ.DdIxfqYaOgJ2cRSoby');
INSERT INTO users VALUES (3, 'user2', '$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi');
INSERT INTO users VALUES (4, 'user1', '$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi');

-- spot price

DROP TABLE IF EXISTS spot_price;
CREATE TABLE spot_price (
    spot_type varchar(50) NOT NULL,
    base_price int NOT NULL,
    incr_price int NOT NULL,
    PRIMARY KEY (spot_type)
);

INSERT INTO spot_price (spot_type, base_price, incr_price) VALUES ('single', 10, 5);
INSERT INTO spot_price (spot_type, base_price, incr_price) VALUES ('double', 20, 10);
INSERT INTO spot_price (spot_type, base_price, incr_price) VALUES ('quad', 40, 20);

-- spot 

DROP TABLE IF EXISTS spot;
CREATE TABLE spot (
    spot_id int NOT NULL AUTO_INCREMENT,
    spot_type varchar(50) NOT NULL,
    spot_status int NOT NULL,
    PRIMARY KEY (spot_id),
    FOREIGN KEY (spot_type) REFERENCES spot_price(spot_type)
);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (1, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (2, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (3, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (4, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (5, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (6, 'single', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (7, 'single', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (8, 'double', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (9, 'double', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (10, 'double', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (11, 'double', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (12, 'double', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (13, 'double', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (14, 'double', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (15, 'double', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (16, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (17, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (18, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (19, 'quad', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (20, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (21, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (22, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (23, 'quad', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (24, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (25, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (26, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (27, 'quad', 0);

INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (28, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (29, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (30, 'quad', 0);
INSERT INTO spot (spot_id, spot_type, spot_status) VALUES (31, 'quad', 0);

-- reservation

DROP TABLE IF EXISTS reservation;
CREATE TABLE reservation (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    spot_id int NOT NULL,
    start_time datetime NOT NULL,
    end_time datetime NOT NULL,
    r_status varchar(50) DEFAULT NULL,
    PRIMARY KEY (id),
	  FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (spot_id) REFERENCES spot(spot_id)
);


-- orders

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    coffee_id int NOT NULL,
    coffee_name varchar(255) NOT NULL,
    quantity int NOT NULL,
    order_status varchar(50) NOT NULL,
    ordered_at datetime NOT NULL,
    expw_time int DEFAULT NULL,
    PRIMARY KEY (id),
	  FOREIGN KEY (coffee_id) REFERENCES coffee(coffee_id),
    FOREIGN KEY (coffee_name) REFERENCES coffee(coffee_name),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

