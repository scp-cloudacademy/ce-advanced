###### 1. file Storage 마운트 정보 확인
   콘솔에서 생성된 파일스토리지 상세정보에 보면 마운트 정보를 확인할 수 있다. </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/350c0c2d-3e9c-4293-8257-a338385d6616)


###### 2. 마운트 정보 확인 후 마운트 실시
```
sudo mount -t nfs -o ver=3 [마운트 정보] [마운트 위치]
```
###### 3. 마운트 확인
```
df -k
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/cd401e8d-4bee-4d56-a580-5154a665d2e8)

###### 4. 마운트 항시 설정
```
sudo vi /etc/fstab
```
```
"198.19.212.11:/fsxy_yqgphp /var/www/html	nfs	default	0 0" </br> 
```
추가 후 저장해준다.

###### 5. 마운트 완료 후 마운트 한 위치에 github에 올려놓은 자료를 다운로드 해준다.
```
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/web.tar [마운트 위치]
```

###### 6. 압축해제
```
sudo tar -xvf web.tar
```

###### 7. 압축이 끝난 후 다른 서버에 접속하여 이전과 동일한 디렉토리에 마운트를 해준다.

마운트가 완료된 후 마운트 폴더로 이동하여 ls 명령어를 치면 깃허브를 통해 다운받은 web.tar파일과 압축을 푼 디렉토리를 확인할 수 있다.
