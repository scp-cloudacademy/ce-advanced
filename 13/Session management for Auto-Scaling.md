# Redis(DBaaS)를 이용한 PHP세션 이중화 구성
## 1. Redis 생성
                                            
## 2. PHP 세션 저장을 위하 Redis 연동설정</br>
경로: /etc/php.ini</br>
```
session.save_handler = redis </br>
sesstion.save_phth = "tcp://redis ip:6378?auth='PASSPHRASE'"
```

### 3. Session 이중화 구성 </br>
PHP 구성된 서버를 절체하면서, Session ID가 유지되지는지 확인! </br>
해당경로에 아래 출력코드를 입력 후 저장해준다 </br>
경로: /usr/share/nginx/html

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
### 4. 이중화 Session 카운트 확인
url/session.php 입력하면 session ID와 함께 카운트 화면이 나오는데 새로고침을 했을 시, 카운트 수가 증가하면 성공
