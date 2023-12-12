# File storage에 저장된 콘텐츠를 Object Storage로 Migration
## 1. object Storage 생성
configuration
1) Multi AZ: 사용
2) 제공범위: 공용
3) 접근제어: 사용안

준비사항 </br>
1> 버킷 명 </br>
2> 퍼블릭 Url </br>
3> 인증키 (Access key, Security key) </br>

## 2. File migration
AWS Cli를 이용 </br>
※ 아직 설치가 되어있지 않다면, [다운로드](https://aws.amazon.com/ko/cli/)클릭하여 다운 및 설치를 진행한다.</br>

### (1) AWS Cli configuration
    aws configure
    access key 
    secret Access key
### (2) 명령어 입력
    aws s3 sync [폴더경로] s3:\\webce\ --endpoint-url [public url]
### (3) 업로드 된 폴더리스트 파일경로 지정
    public Acess 권한부여
### (4) Source code 반영
    index.php 의 파일경로를 [./web] → [endpoint/버킷명] 일괄변경

## 3. APP Server에서 경로변경
변경한 Source code를 App Server에 적용
### 1. html 경로 이동
    cd /usr/share/nginx/html
    ls     # 항목확인
### 2. 변경한 Source 코드 index.php 파일생성 (임의 파일생성 후 변경)
    sudo vi index.php1    # 변경한 소스코드 저장
    sudo chown vmuser:vmuser index.php1    # 사용권한 변경
    sudo chmod 755 index.php1    # 파일권한 부여
    sudo mv index.php index.php.back    # 원본파일을 백업용으로 변경
    sudo mv index.php1 index.php    # 변경한 소스코드 파일을 원본으로 변
    sudo systemctl restart php-fpm    # 시스템 재시작
### 3. 변경한 내용 홈페이지에서 확인
### 4. 또 다른 App Server에도 반영
    
    
