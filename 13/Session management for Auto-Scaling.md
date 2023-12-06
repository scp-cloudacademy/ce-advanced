#### 1. Redis(DBaaS) 생성하기
모든상품 ▶ Redis(DBaaS) ▶ 상품신청을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e19f37ef-6005-4b09-bf47-d494f93380bd)
이미지와 버전 선택 후 다음을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/055420bd-997f-4eb1-8cdd-720facb1dd35)





# Redis(DBaaS)를 이용한 PHP세션 이중화 구성
1. PHP 세션 저장을 위하 Redis 연동설정</br>
경로: /etc/php.ini</br>
```
session.save_handler = redis </br>
sesstion.save_phth = "tcp://redis ip:6378?auth='PASSPHRASE'"
```

2. Session 이중화 구성 </br>
PHP 구성된 서버를 절체하면서, Session ID가 유지되지는지 확인! </br>
해당경로에 아래 출력코드를 입력 후 저장해준다 </br>
경로: /var/www/html/session.php

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

저장이 완료된 후, url/session.php 입력해주면 아래 그림과 같이 결과가 나오면 성공 </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8de8b04d-982b-40bf-95a5-cc3188c43758)
