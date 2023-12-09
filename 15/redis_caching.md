# MySQL Caching with Redis

  **Scenario :** Cosmetic Evolution Shoppingmall severs

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Redis(DBaaS) 

---


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


### Reference
https://www.digitalocean.com/community/tutorials/how-to-set-up-redis-as-a-cache-for-mysql-with-php-on-ubuntu-20-04

