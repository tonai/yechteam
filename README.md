# Yechteam

Connect to mysql:
```sh
sudo mysql
```

Then create database and user:
```sql
CREATE DATABASE yechteam;
CREATE USER 'yechteam'@'localhost' IDENTIFIED BY 'maethcey';
GRANT ALL ON yechteam.* TO 'yechteam'@'localhost';
```
