用php做简单的ajax异步调用接口(login.php)。
文件loginJsonp.php为做过Jsonp跨域处理的接口（调用参考文件夹html下的jsonp.html文件）。
文件loginCros.php为采用cros跨域处理的接口（调用参考html文件夹下的cros.html文件）。
文件signIn.php用于注册，并把注册信息写入数据库。（signIn.html）


创建数据库命令：
CREATE DATABASE map_db//创建数据库

CREATE TABLE users//创建表
(
Id int,
m_userName varchar(25),
m_password varchar(25)
)

INSERT INTO users values(1,'mango',123456);//新增一行数据

select * from users;