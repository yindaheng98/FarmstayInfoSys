# FarmstayInfoSys
A website based on php and bootstrap, used for farmstay information management.

The database is MySQL, please use create.sql to set up database and import City.sql to the database 'City' before launch the website.

!!!Use UTF-8 mysql-server and mysql-client!!!

一套基于php和bootstrap的农家乐信息管理系统。
数据库是MySQL，启用网站前请先用create.sql建数据库。

包含如下功能：

1. 农家乐商户注册
2. 农家乐商户信息上传
3. 农家乐游客用户注册
4. 按地区和名称检索农家乐商户
5. 游客对农家乐商户进行评级和评论

使用方法：
1. 把mysql客户端和服务器都设成UTF-8模式
2. 用create.sql建立两个数据库Farmstay和City
3. 用数据库导入工具把City.sql导入到City数据库中
4. 把网站放到服务器上
5. Have fun