drop database if exists Farmstay;
create database Farmstay DEFAULT CHARACTER SET utf8;
use Farmstay;
CREATE table 用户
(
用户名 varchar(255) not null,
密码 varchar(255) not null,
注册时间 datetime not null,
primary key(用户名),
index(用户名)
);
create table 商户
(
用户名 varchar(255) not null,
密码 varchar(255) not null,
注册时间 datetime not null,
商户名称 varchar(255) not null,
商户描述 varchar(255) not null,
商户位置 varchar(255) not null,
详细地址 varchar(255) not null,
商户评级 tinyint not null,
营业执照 varchar(255) not null,
商户照片 varchar(255) not null,
primary key(用户名),
index(用户名),
index(商户名称),
index(商户位置),
index(商户评级)
);
create table 评价
(
id bigint auto_increment,
用户 varchar(255) not null,
商户 varchar(255) not null,
内容 varchar(255) not null,
打分 tinyint not null,
时间 datetime not null,
图片 varchar(255) null,
primary key(id),
index(用户),
index(商户),
foreign key(用户) references 用户(用户名)
on update cascade
on delete cascade,
foreign key(商户) references 商户(用户名)
on update cascade
on delete cascade
);

create user Farmstay identified by 'Farmstay';
GRANT SELECT ,UPDATE ,INSERT ON Farmstay.* TO 'Farmstay'@'localhost' IDENTIFIED BY 'Farmstay';
flush privileges;

drop database if exists City;
create database City DEFAULT CHARACTER SET utf8;
use City;
create user City identified by 'City';
GRANT SELECT ,UPDATE ,INSERT ON City.* TO 'City'@'localhost' IDENTIFIED BY 'City';
flush privileges;
