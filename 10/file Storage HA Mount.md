# 1. File upload 장애테스트
# 2. File Storage 공유 스토리지 생성
※ 생성 후 확인사항
1) 마운트정보 확인 
2) 적용서버 추가 (마운트 될 서버 추가)
3) 서버에 접속 후 마운트 위치로 이동 </br>
````
cd /usr/share/nginx/html
````
# 3. 서버 마운트
#### 1. 자료가 중복되지 않도록 자료 이동시킴
    sudo mv web web1
#### 2. 마운트 할 디렉토리 생성
    sudo mkdir web
#### 3. nfs-util 설치
    sudo yum -y install nfs-utils
#### 4. 서버 마운트
    sudo mount -t nfs -o =ver=3 [마운트정보] [마운트 위치]    # 서버 마운트
    df -h    # 마운트 확인
#### 5. 이동한 자료를 마운트 된 서버로 이동
    sudo mv web1/* web
#### 6. 작업한 경로에서 권한설정 (파일 디렉토리에 대한 쓰기권한 부여)
    sudo chmod 777 file
