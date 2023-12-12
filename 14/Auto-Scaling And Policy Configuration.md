# Auto-Scale
## 1. Custom Image 만들기
## 2. Launch Configuration 생성
### init script 
##### WEB
    sudo systemctl enable nginx
    sudo systemctl start nginx
##### App
    #!/bin/bash
    sudo systemctl enable php-fpm
    sudo systemctl start php-fpm
## 3. LoadBalancer 서비스 생성
### Configuration
###### WEB
    서비스 포트: 80
    NAT IP: 사용
##### App
    서비스 포트: 9000
## 4. Auto-scaling 서비스 신청
### Configuration
##### Web
    서버 수  Min:2  Desired:4  Max:6
    로드밸런서 사용
    Web용 서비스 선택
    정책: 나중에 설정
##### App
    서버 수  Min:2  Desired:4  Max:6
    로드밸런서 사용
    App용 서비스 선택
    정책: 나중에 설정

# Auto-scaling Policy
## 1. Scale in/out policy
### Configuration 
#### Web
    MAX  CPU usage  >=  60%  1분    # Scale out 조건
    Average  CPU usage  <=  30%  1분    #Scale In  조건
#### App
    Average  Memory usage  >=  60%  1분  # Scale out 조건
    Average  Memory usage  <=  20%  1분  # Scale In 조건
## 2. 모니터링 
## 3. 서비스 확인
1) 기존서버 다운 
2) 오토스케일링 서비스 헬스체크 포인트 수정 </br>
  Web 8080 ▶ 80 </br>
  App 8080 ▶ 9000
3) 도메인 레코드 설정
```
내부 도메인
www: 192.168.14.3
WAS: 192.168.14.4

Public Domain
Web asg의 NAT IP
```
### 4. Stress Test  
    
     
