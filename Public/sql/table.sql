CREATE DATABASE ZNO CHARACTER SET UTF8;

insert into mysql.user(Host,User,Password) values("localhost","MrZhang",password("zhang"));

GRANT USAGE ON *.* TO 'MrZhang'@'localhost' IDENTIFIED BY PASSWORD '*5D83A6402DF44A7D8EC2B8861B19F8A2F4F3EA2F';

GRANT ALL PRIVILEGES ON `zno`.* TO 'MrZhang'@'localhost' WITH GRANT OPTION;

USE ZNO;

drop table if exists think_user;

drop table if exists think_personelinfo;

drop table if exists think_board;

drop table if exists think_category;

drop table if exists think_questions;

drop table if exists think_agreereply;

drop table if exists think_agreequestion;

drop table if exists think_ConQuesTag;

drop table if exists think_replies;

drop table if exists think_starquestion;

drop table if exists think_starreply;

drop table if exists think_staruser;

drop table if exists think_tags;

CREATE TABLE think_user (
  user_id INT AUTO_INCREMENT,
  usermail VARCHAR(32),
  password VARCHAR(40),
  username VARCHAR(32),
  image VARCHAR(32),
  PRIMARY KEY (user_id)
);

CREATE TABLE think_personelinfo(
  user_id INT,
  credit INT default 50,
  gender BOOLEAN default true,
  residence VARCHAR(32) default '中国',
  education VARCHAR(32) default '南京大学',
  profession VARCHAR(32) default '软件工程师',
  mood VARCHAR(64),
  introduction VARCHAR(300),
  todayQuestions INT,
  publishedToday INT default 0,
  unreadBoard BOOLEAN default false,
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE CASCADE 
);

CREATE TABLE think_category(
  category_id INT AUTO_INCREMENT,
  think_category VARCHAR(32),
  PRIMARY KEY (category_id)
);

CREATE TABLE think_tags(
  tag_id INT AUTO_INCREMENT,
  tag VARCHAR(32),
  category_id INT,
  PRIMARY KEY (tag_id),
  FOREIGN KEY (category_id) REFERENCES think_category(category_id) ON DELETE CASCADE
);

CREATE TABLE think_questions(
  Qid INT AUTO_INCREMENT,
  user_id INT,
  title VARCHAR(64),
  content VARCHAR(1024),
  starNum INT default 0,
  agreeNum INT default 0,
  answerNum INT default 0,
  ifFixed INT default -1,
  pictures VARCHAR(32),
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  readNum INT default 0,
  credit INT not null,
  PRIMARY KEY (Qid),
  FOREIGN KEY (tag_id) REFERENCES think_tags(tag_id) ON DELETE RESTRICT,
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE RESTRICT
);

CREATE TABLE think_ConQuesTag(
  Qid INT,
  tag_id INT,
  FOREIGN KEY (tag_id) REFERENCES think_tags(tag_id) ON DELETE RESTRICT,
  FOREIGN KEY (Qid) REFERENCES think_questions(Qid) ON DELETE RESTRICT,
  PRIMARY KEY (Qid,tag_id)
);

CREATE TABLE think_replies(
  Rid INT AUTO_INCREMENT,
  user_id INT,
  Qid INT,
  floors INT,
  reply VARCHAR(1024),
  pictures VARCHAR(32),
  agreeNum INT default 0,
  publishDate TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,,
  PRIMARY KEY (Rid),
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE RESTRICT,
  FOREIGN KEY (Qid) REFERENCES think_questions(Qid) ON DELETE CASCADE
 );
 
 CREATE TABLE think_board(
   msg_id INT AUTO_INCREMENT,
   to_id INT,
   from_id INT,
   message VARCHAR(256),
   date timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,,
   PRIMARY KEY (msg_id),
   FOREIGN KEY (to_id) REFERENCES think_user(user_id) ON DELETE CASCADE,
   FOREIGN KEY (from_id) REFERENCES think_user(user_id) ON DELETE CASCADE
 );
 
 CREATE TABLE think_staruser(
  star_id INT AUTO_INCREMENT,
  from_id INT,
  to_id INT,
  PRIMARY KEY (star_id),
  FOREIGN KEY (to_id) REFERENCES think_user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (from_id) REFERENCES think_user(user_id) ON DELETE CASCADE
);

 CREATE TABLE think_starquestion(
  star_id INT AUTO_INCREMENT,
  user_id INT,
  Qid INT,
  PRIMARY KEY (star_id),
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (Qid) REFERENCES think_questions(Qid) ON DELETE CASCADE
);
  
 CREATE TABLE think_agreereply(
  agree_re_id INT AUTO_INCREMENT,
  user_id INT,
  Rid INT,
  PRIMARY KEY (agree_re_id),
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (Rid) REFERENCES think_replies(Rid) ON DELETE CASCADE
);

 CREATE TABLE think_agreequestion(
  agree_qu_id INT AUTO_INCREMENT,
  user_id INT,
  Qid INT,
  PRIMARY KEY (agree_qu_id),
  FOREIGN KEY (user_id) REFERENCES think_user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (Qid) REFERENCES think_questions(Qid) ON DELETE CASCADE
);
 
insert into think_user(usermail,password,username) values('374645377@qq.com',SHA('0oo0o00o'),'MrJoke');
insert into think_personelinfo(user_id) values('1');
insert into think_category (category_id,think_category) values (1,'数据库');
insert into think_category (category_id,think_category) values (2,'操作系统');
insert into think_category (category_id,think_category) values (3,'网络技术');
insert into think_category (category_id,think_category) values (4,'开发技术');
insert into think_category (category_id,think_category) values (5,'移动技术');
insert into think_tags (tag,category_id) values ('Access',1);
insert into think_tags (tag,category_id) values ('DB2',1);
insert into think_tags (tag,category_id) values ('MySQL',1);
insert into think_tags (tag,category_id) values ('Oracle',1);
insert into think_tags (tag,category_id) values ('SQLServer',1);
insert into think_tags (tag,category_id) values ('Sybase',1);
insert into think_tags (tag,category_id) values ('Other DATABASE',1);
insert into think_tags (tag,category_id) values ('DOS',2);
insert into think_tags (tag,category_id) values ('Linux',2);
insert into think_tags (tag,category_id) values ('MacOS',2);
insert into think_tags (tag,category_id) values ('OS',2);
insert into think_tags (tag,category_id) values ('Solaris',2);
insert into think_tags (tag,category_id) values ('Ubuntu',2);
insert into think_tags (tag,category_id) values ('Unix',2);
insert into think_tags (tag,category_id) values ('Windows Server',2);
insert into think_tags (tag,category_id) values ('Other OS',2);
insert into think_tags (tag,category_id) values ('网管软件',3);
insert into think_tags (tag,category_id) values ('网络基础',3);
insert into think_tags (tag,category_id) values ('网络监控',3);
insert into think_tags (tag,category_id) values ('网络设备',3);
insert into think_tags (tag,category_id) values ('系统集成',3);
insert into think_tags (tag,category_id) values ('综合布线',3);
insert into think_tags (tag,category_id) values ('ActionScript',4);
insert into think_tags (tag,category_id) values ('C#',4);
insert into think_tags (tag,category_id) values ('C',4);
insert into think_tags (tag,category_id) values ('C++',4);
insert into think_tags (tag,category_id) values ('Delphi',4);
insert into think_tags (tag,category_id) values ('java',4);
insert into think_tags (tag,category_id) values ('JavaScript',4);
insert into think_tags (tag,category_id) values ('Perl',4);
insert into think_tags (tag,category_id) values ('PHP',4);
insert into think_tags (tag,category_id) values ('Python',4);
insert into think_tags (tag,category_id) values ('VB',4);
insert into think_tags (tag,category_id) values ('Web开发',4);
insert into think_tags (tag,category_id) values ('硬件开发',4);
insert into think_tags (tag,category_id) values ('Others',4);
insert into think_tags (tag,category_id) values ('Android',5);
insert into think_tags (tag,category_id) values ('BlackBerry',5);
insert into think_tags (tag,category_id) values ('Flash',5);
insert into think_tags (tag,category_id) values ('HTMLL',5);
insert into think_tags (tag,category_id) values ('IOS',5);
insert into think_tags (tag,category_id) values ('JavaME',5);
insert into think_tags (tag,category_id) values ('MeeGo',5);
insert into think_tags (tag,category_id) values ('Windows Phone',5);
insert into think_tags (tag,category_id) values ('Symbian',5);
insert into think_tags (tag,category_id) values ('Others',5);