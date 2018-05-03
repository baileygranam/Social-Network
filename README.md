# MVC PHP Social Network
## By: Bailey Granam
- Utilizes CodeIgniter 3.0 Framework
- Login / Logout
- Friends System
- Posting System (Audio/Video/Images)
- Like Posts
- Create Groups

## Setup

To run this program you must follow these steps:
1. git clone https://github.com/baileygranam/cinf301-spr18-project-05.git
1. docker pull fauria/lamp
1. docker build . 
1. docker run -d --name lamp -p 8085:80 -v $(PWD)/app:/var/www/html fauria/lamp
1. docker exec -it lamp /bin/bash
1. service apache2 start
1. exit
1. docker run --name mysql -p 33060:3306 -e MYSQL_ROOT_PASSWORD=password -d mysql:5.7.22
1. docker exec -it mysql bash
1. mysql -uroot -ppassword
1. create database iluminous;
1. quit
1. exit
1. docker exec -i mysql mysql -uroot -ppassword iluminous < data.sql

If any errors occur such as connection refused on the application go to /app/app/config/database.php and replace
'hostname' => '172.17.0.3:3306' with the IP of your MYSQL docker container. To get this IP simply run 'docker inspect mysql'.
