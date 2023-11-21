###### 1. file Storage 마운트 정보 확인
   콘솔에서 생성된 파일스토리지 상세정보에 보면 마운트 정보를 확인할 수 있다. </br>
  ![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/02dd33b9-ed2f-42ac-b98d-c32170533ac0)

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

"198.19.212.11:/fsxy_yqgphp /var/www/html	nfs	default	0 0" </br> 
추가 후 저장해준다.

###### 5. 다른 서버도 동일하게 마운트 실시해준다.
###### 6. 마운트 완료 후 마운트 한 위치에 github에 올려놓은 자료를 다운로드 해준다.
```
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/web.tar [마운트 위치]
```

다운로드 완료 후 다른 서버에 마운트한 위치에 가보면 다운로드 된 파일을 확인할 수 있다.

######7. 압축해제
```
sudo tar -xvf web.tar
```
