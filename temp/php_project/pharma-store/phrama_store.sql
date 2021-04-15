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

-- meds

DROP TABLE IF EXISTS medicine;
CREATE TABLE medicine (
  medicine_id int NOT NULL AUTO_INCREMENT,
  medicine_name varchar(255) NOT NULL,
  medicine_price int NOT NULL,
  medicine_qty int NOT NULL,
  stock_alert varchar(255) DEFAULT NULL,
  PRIMARY KEY (medicine_id),
  KEY index_medicine_name (medicine_name)
);

INSERT INTO medicine (medicine_id, medicine_name, medicine_price, medicine_qty, stock_alert) VALUES (1, 'Med-01', 12, 5, 'sufficient');
INSERT INTO medicine (medicine_id, medicine_name, medicine_price, medicine_qty, stock_alert) VALUES (2, 'Med-02', 20, 10, 'sufficient');
INSERT INTO medicine (medicine_id, medicine_name, medicine_price, medicine_qty, stock_alert) VALUES (3, 'Med-03', 17, 9, 'sufficient');
INSERT INTO medicine (medicine_id, medicine_name, medicine_price, medicine_qty, stock_alert) VALUES (4, 'Med-04', 27, 14, 'sufficient');

-- employees

DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
  id int NOT NULL AUTO_INCREMENT,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  hashed_password varchar(255) DEFAULT NULL,
  current_orders int NOT NULL,
  PRIMARY KEY (id),
  KEY index_username (username)
);

INSERT INTO employees VALUES (1,'elliot','employee','elliot@employee.com','elliot','$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi', 0);
INSERT INTO employees VALUES (2,'elliot1','employee1','elliot1@employee.com','elliot1','$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi', 0);
INSERT INTO employees VALUES (3,'elliot2','employee2','elliot2@employee.com','elliot2','$2y$10$HAxKzLL61e2HqGRg72./5uVRMcAKtgsn5DKGq4TR2kxErPhIwLssi', 0);

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

-- orders

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    employee_id int NOT NULL,
    medicine_id int NOT NULL,
    medicine_name varchar(255) NOT NULL,
    quantity int NOT NULL,
    order_status varchar(50) NOT NULL,
    ordered_at datetime NOT NULL,
    PRIMARY KEY (id),
	  FOREIGN KEY (medicine_id) REFERENCES medicine(medicine_id),
    FOREIGN KEY (medicine_name) REFERENCES medicine(medicine_name),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

