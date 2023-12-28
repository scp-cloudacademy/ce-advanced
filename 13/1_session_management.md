# PHP session management using Redis(DBaaS)

## 1. Create Redis
                                            
## 2. Configure Redis connection for PHP session management</br>
In App Server
```
sudo vi /etc/php.ini
session.save_handler = redis
sesstion.save_phth = "tcp://redis ip:6378?auth='PASSPHRASE'"
```

### 3. Configure Session management </br>
Create PHP file to check session  </br>
</br>

    sudo vi /usr/share/nginx/html/session.php

Copy and Paste code below

```
<?php

session_start();
echo 'PHP session ID: ';
echo session_id();
echo '<br />';

$count = isset($_SESSION['count']) ? $_SESSION['count'] : 1;
echo 'Count: ';
echo $count;
echo '<br />';
$_SESSION['count'] = ++$count;

?>
```

### 4. Check Session count

http://[url]/session.php
