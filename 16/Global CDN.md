#### 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn)

가이드를 참고하여 생성하면 된다. 이때 주의사항은 Forward host header 및 Cache key hostname은 Origin Hostname으로 설정해준다.</br>
CDN 생성이 완료가 되면, 방화벽 또는 Security Group 설정이 필요한 경우 추가 설정을 해주면 된다.

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
** 한번에 여러개의 도메인의 인증서를 발급받을 수 있으며 "-d 발급받을 도메인주소"를 넣어주면 된다.
