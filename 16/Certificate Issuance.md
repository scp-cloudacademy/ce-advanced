### 1. HTTPS 무료인증서 발급받기
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
###### ※ 인증서는 절차가 간소한 standalone 방식으로 발급하며, 발급 전 웹서버 서비스를 잠시 중지시켜야 한다.
```
sudo systemctl stop httpd
```

3) 인증서 발급

```
sudo certbot --standalone -d (발급받을 도메인주소)
```
* 한번에 여러개의 도메인의 인증서를 발급받을 수 있으며 "-d 발급받을 도메인주소"를 넣어주면 된다.
* 해당 명령어 입력하면 이메일 주소를 넣게 되어있으며, ACME 서버등록 동의해주고, 이메일 수신여부를 체크해준다.
  일련의 과정이 끝나면 발급이 완료가 된다.</br>

* ※ 발급이 완료가 되면, 인증서 및 키가 저장된 위치를 확인할 수 있으며, 해당 위치는 잘 기억할 수 있도록 해준다.

```
ls -l /etc/letsencrypt/archive/도메인
```

4) SSL 패키지 설치
```
sudo yum -y install openssl mod_ssl
```
4-1) SSL 패키지 설치확인
```
sudo cat /etc/httpd/conf.modules.d/00-ssl.conf
ls -l /etc/httpd/modules/
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/eef55920-20b2-4771-be72-fa93046ea6ff)

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

모든 일련의 과정이 끝나면 인증서발급이 완료가 되고, 해당 내용을 바탕으로 SCP에 등록을 해준다.


### 2. SCP 인증서 등록하기

모든상품 ▶ Security ▶ Certificate Manager 상품신청을 클릭해준다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1c34bb1a-62cf-4e71-9de9-113609bee82c)

인증서명을 넣어주고, 각 항목에 맞는 인증서 정보를 조회한 후, 값을 넣어준다.</br>
항목에 값을 모두 넣어준뒤 인증서 유효체크를 하고, 다음을 눌러 생성을 해준다.</br>

※ Certificat Chain 값을 넣을 때는 Certificate Chain은 Intermediate CA(Subordinate CA) → Root CA 순서로 입력을 하고,</br> 
해당 내용 관련 SCP 인증서 가이드 참고 </br>
[SCP 인증서 등록가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#4741ae3ae409b228)

### 3. SSL 유효성 체크
SCP 인증서까지 등록이 완료가 되면, 서버에서 SSL 유효성 체크를 실시한다.</br>

1st Step
```
sudo openssl crl2pkcs7 -nocrl -certfile /etc/letsencrypt/archive/등록도메인/cert1.pem | openssl pkcs7 -print_certs -noout
```

2nd Step
```
sudo openssl x509 -noout -modulus -in /etc/letsencrypt/archive/등록도메인/cert1.pem | openssl md5
sudo openssl rsa -noout -modulus -in /etc/letsencrypt/archive/등록도메인/privkey1.pem | openssl md5
```
두개의 값이 일치하는지 확인

3rd Step
```
sudo openssl x509 -noout -in /etc/letsencrypt/archive/등록도메인/cert1.pem -dates
```
인증서 유효기간 확인 기간이 지나면 갱신필요

4th Step
```
sudo openssl verify -CAfile /etc/letsencrypt/archive/등록도메인/chain1.pem /etc/letsencrypt/archive/등록도메인/cert1.pem
```
4번째까지 명령어를 입력을 하면 에러가 생성됨
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b2868ebd-df47-45da-bd8c-d681dfdff0e7)

■ 해결방법
1. self-signed Root certificate download
```
sudo wget https://letsencrypt.org/certs/isrgrootx1.pem --no-check-certificate
```
2. Chain1.pem 파일을 복제한다.
```
sudo cp /etc/letsencrypt/archive/등록 도메인/chain1.pem /etc/letsencrypt/archive/등록 도메인/chain1_copy.pem
```
3. Chain1.pem의 Root Certificate 부부을 self-signed root certificate(1에 다운로드 파일내용으로 복사 후 넣어주면 됨)로 변경
4. 4th Step의 명령어를 다시입력</br>
결과값에 '/etc/letsencrypt/archive/등록 도메인/cert1.pem: OK' 라고 나오면 완료
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/617cbca8-2835-407d-83f9-15855aa9caec)

