# 1. Replica 구성하기
# 2. Redis-caching 구성하기
## Security 규칙 추가
[AppSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/app.xlsx) </br>
[DBSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/db.xlsx)
# 3. Redis-cache 구성하기
## Server Setup

### 1. Install php-redis

    sudo yum install php-redis

### 2. Patching Redis to PHP database source

[apiDatabase.php](https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/apiDatabase_redis.php)

```bash
cd /usr/share/nginx/html/was
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/apiDatabase_redis.php
sudo mv apiDatabase.php apiDatabase.php.bak
sudo mv apiDatabase_redis.php apiDatabase.php 
sudo chown vmuser:vmuser apiDatabase.php
sudo systemctl restart php-fpm
```
