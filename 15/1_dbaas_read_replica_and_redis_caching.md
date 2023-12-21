# 1. Configure Read Replica

# 2. Configure Redis-caching
## Adding Security Group rules
[AppSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/15_app_security_group.xlsx) </br>
[DBSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/15/15_db_security_group.xlsx)

# 3. Configure Redis-cache
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
sudo chmod 755 apiDatabase.php
sudo systemctl restart php-fpm
```
### Reference
https://www.digitalocean.com/community/tutorials/how-to-set-up-redis-as-a-cache-for-mysql-with-php-on-ubuntu-20-04

# 4.Test
