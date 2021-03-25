create table User (
    user_id int primary key auto_increment,
    user_name varchar(50) not null,
    user_passwd varchar(50) not null
);

create table Order_by (
    order_id int primary key auto_increment,
    user_id int,
    time_ordered time not null,
    order_status int not null,
    foreign key (user_id) references User(user_id)
);

create table Coffee (
    coffee_id int primary key auto_increment,
    coffee_name varchar(50) not null,
    coffee_price int not null,
    cook_time int not null,
    trend_val int
);

create table order_items (
    order_id int,
    coffee_id int,
    quantity int not null,
    item_status int not null,
    primary key (order_id, coffee_id),
	foreign key (order_id) references Order_by(order_id),
    foreign key (order_id) references Coffee(coffee_id)
);

create table spot_price (
    spot_type varchar(50) primary key,
    base_price int not null,
    incr_price int not null
);

create table Spot (
    spot_id int primary key auto_increment,
    spot_type varchar(50),
    spot_status int not null,
    foreign key (spot_type) references spot_price(spot_type)
);

create table Reservation (
    user_id int,
    spot_id int,
    start_time time not null,
    end_time time not null,
    primary key(user_id, spot_id),
	foreign key (user_id) references User(user_id),
    foreign key (spot_id) references Spot(spot_id)
);

create table Employee (
    employee_id int primary key auto_increment,
    employee_name varchar(50) not null,
    salary int not null
);