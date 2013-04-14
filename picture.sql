#仿写166122.com程序的数据库
#修改数据库的字段名，方便使用多表查询。对此，我不是很理解。当不同表的字段同名时，用多表查询，结果中的一些数据会被覆盖。
create database picture default character set utf8 collate utf8_general_ci;

use picture;

create table topic
(
    topicId int not null auto_increment primary key,
	topicName varchar(12) not null
);

create table album
(
    albumId int not null auto_increment primary key,
	albumName varchar(60) not null,
	thumbId int not null,#缩略图ID
	topicId int not null,#栏目ID
	picrows int not null,#图集的图片数量，2013年3月22日补充
	post TIMESTAMP not null  #发布图集的时间
	#thumbUlr varchar(60) default 
);

create table picture
(
    picId int not null auto_increment primary key,
	albumId int not null,#相册ID。将缩略图的相册ID设定为0
	url varchar(60) not null #图片地址
);



create table admin
(
    adminId int not null auto_increment primary key,
	adName varchar(18) not null,#name
	adPwd char(200) not null #how long is password?Which function should I use to hash password?
);  #2013年3月13日补充

create table user
(
	userId int not null auto_increment primary key,
	userName varchar(18) not null,
	userPwd char(200) not null
);#2013年4月3日补充

create table friend
(
	friendId int not null auto_increment primary key,
	friendSrc int not null,       #被关注的人 userId 
	friendDesc int not null       #关注某人的人 userId 
);#2013年4月8日补充

create table messageIndex     #存储用户发言信息的索引
(
	messageId int not null auto_increment primary key,
	contentId int not null,
	messagePosterId int not null    #发言者ID
);#2013年4月8日补充。暂时不使用这个表

create table content     #存储用户发言的内容
(
	contentId int not null auto_increment primary key,
	userId int not null,#发表此内容的用户的ID
	#posterId int not null,
	content mediumtext not null,
	post timestamp 	
);#2013年4月8日补充

create table mail     #存储用户发送的私信
(
	mailId int not null auto_increment primary key,
	senderId int not null,#发送私信的用户ID
	receiverId int not null,#接收私信的用户ID
	mailContent mediumText not null,#私信内容
	mailTime timestamp   #发送时间
);#2013年4月10日补充

grant select,delete,update,insert
on picture.*
to picture@localhost identified by 'password';