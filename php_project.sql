create table if not exists `products`(
`product_id` int(11) not null auto_increment,
`product_name` varchar(100) not null,
`product_category` varchar(100) not null,
`product_description` varchar(255) not null,
`product_image` varchar(255) not null,
`product_image2` varchar(255) not null,
`product_image3` varchar(255) not null,
`product_image4` varchar(255) not null,
`product_price` decimal(6,2) not null,
`product_special_offer` integer(2)not null,
`product_color` varchar(100)not null,
primary key(`product_id`)
)engine=innodb default charset=latin1;

create table if not exists `orders`(
`order_id` int(11) not null auto_increment,
`order_cost` decimal(6,2) not null,
`order_status` varchar(100) not null default 'on_hold',
`user_id` int(11) not null,
`user_phone` int(11) not null,
`user_city` varchar(255) not null,
`user_address` varchar(255) not null,
`order_date` datetime not null default current_timestamp,
primary key(`order_id`)
)engine=innodb default charset=latin1;

create table if not exists `order_items`(
`item_id` int(11) not null auto_increment,
`order_id` int(11) not null,
`product_id` varchar(255) not null,
`product_name` varchar(255) not null,
`product_image` varchar(255) not null,
`user_id` int(11) not null,
`order_date` datetime not null default current_timestamp,
primary key(`item_id`)
)engine=innodb default charset=latin1;

create table if not exists `users`(
`user_id` int(11) not null auto_increment,
`user_name` varchar(255) not null,
`user_email` varchar(255) not null,
`user_password` varchar(255) not null,
primary key(`user_id`),
unique key `UX_Constraint` (`user_email`)
)engine=innodb default charset=latin1;

create table if not exists `admins`(
`admin_id` int(11) not null auto_increment,
`admin_name` varchar(255) not null,
`admin_email` text not null,
`admin_password` text not null,
primary key(`admin_id`)
)engine=innodb default charset=latin1;


