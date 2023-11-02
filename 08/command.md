# SSH 접속하기
[Putty 다운로드](https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html/) </br></br>
본인이 사용하는 pc 사양에 맞는 버전을 다운로드 받고, 설치를 한다.</br>
설치가 완료된 후, [접속방법](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#61ddd538a41cdb3d/)을 참고하여 접속해준다

# Apache HTTP Server 패키지 설치 및 환경구성
##### http 설치 
```
sudo yum -y install httpd
sudo systemctl start httpd.service
sudo systemctl enable httpd.service
```
