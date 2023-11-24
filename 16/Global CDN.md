#### 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn)

가이드를 참고하여 생성하면 된다. 이때 주의사항은 Forward host header 및 Cache key hostname은 Origin Hostname으로 설정해준다.</br>
원본설정의 프로토콜은 2가지 중 등록할 도메인의 프로토콜에 맞춰 선택을 해주면 된다.</br>
CDN 생성이 완료가 되면, 원본서버에 대한 firewall 및 Security Group에 허용규칙을 추가해준다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1876c216-9001-465b-a60a-2645387e5076)


#### 2. HTTPS 무료인증서 발급받기
[인증서 발급 참고](https://blog.jiniworld.me/137#a02-1)

1) 레포지토리 조회
```
yum repolist | grep epel
```
* 조회가 안되는 경우 설치
  ```
  sudo yum -y install epel-release
  ```
2) Certbot 설치
```
sudo yum install certbot python2-certbot-apache
```
###### ※ 인증서는 절차가 간소한 standalone 방식으로 발급예정이며, 발급 전 웹서버 서비스를 잠시 중지시켜야 한다.
```
sudo systemctl stop httpd
```

3) 인증서 발급
```
sudo certbot --standalone -d (발급받을 도메인주소)
```
* 한번에 여러개의 도메인의 인증서를 발급받을 수 있으며 "-d 발급받을 도메인주소"를 넣어주면 된다.
* 해당 명령어 입력하면 이메일 주소를 넣게 되어있으며, 발급에 동의를 해주고, 이메일 수신여부를 체크해준다.

일련의 과정이 끝나면 발급이 완료가 된다.</br>

4) SSL 패키지 설치
```
sudo yum -y install openssl mod_ssl
```
5) SSL 설정변경
```
sudo vi /etc/httpd/conf.d/ssl.conf
```

```
DocumentRoot "/var/www/html/..."
ServerName "도메인:443"

- SSLCertificateFile /etc/letsencrypt/archive/도메인/cert1.pem
- SSLCertificateKeyFile /etc/letsencrypt/archive/도메인/privkey1.pem
- SSLCertificateChainFile /etc/letsencrypt/archive/도메인/chain1.pem
- SSLCACertificateFile /etc/letsencrypt/archive/도메인/fullchain1.pem
```

6) Apache 설정에서 ssl.conf 추가
```
sudo vi /etc/httpd/conf/httpd.conf
```
IncludeOptional conf.d/*.conf 주석해제(확인할 것)

#### 3. SSL 유효성 체크
