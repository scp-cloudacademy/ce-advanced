<h1>ZConverter</h1>

- 환경 </br>
사용 OS : CentOS 7.8 </br>
Source VM : VMware Workstation </br>
Target VM : Samsung Cloud Platform </br>

- bastion-dmz의 Security Group과 IGW F/W 사용 PORT </br>
관리포탈 사용 포트 : 58080
Agent 확인 포트 : 50001,50000</br>
마이그레이션 포트 : 50005</br>

- ZConverter 설치
[다운로드](https://objectstorage.ap-seoul-1.oraclecloud.com/p/1n9M3ZGv_raosujWb2EExwKV3FfsFQyn02gsLvr2R5ttpnESDGFBXYXqYrqXFYAc/n/idffti7li8cs/b/ZConverter_Bucket/o/ZConverter_CloudManager_Setup_v4.1_2023_0619_private.exe)

<h3>Source Agent 설치</h3>

```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_source/
./install.sh
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/de093b96-737b-43ff-aae8-7aac1e811fad)<br>
Enter

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a4c44cde-37f1-48ac-bf31-a7a384664754)<br>
2. ZCM 선택

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6b3d140d-4c57-41fc-b1ed-c9ccb62ae9af)<br>
관리포탈 IP 입력

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ae5e605d-73a5-4d6f-a480-648eecace0fe)<br>
관리포탈 접속 ID 입력

<h3>Target Agent 설치</h3>

```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_target/
./install.sh
```

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/38d31953-4504-41db-a93b-1af50b23fd29><br>
Enter<br>

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e6dc9346-1ce5-4fb1-bd9b-267bb9ee298b><br>
2. ZCM 선택<br>

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3107e7ab-4247-4187-ad8a-f4962e76b0a8><br>
관리포탈 IP 입력<br>

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9eb4085f-82c2-4dec-aeb6-ed4f9e39daf4><br>
관리포탈 접속 ID 입력<br>

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f24e959e-4365-4b44-96a5-89dcfee12c3b><br>
Target VM에 구성될 ZConverter 저장소 추가 확인<br>

<h3>ZConverter</h3>
관리포탈에서 "클라우드 마이그레이션" 메뉴에서 소스 서버와 타겟 서버를 등록하여 마이그레이션 실행
<br>
<br>
관리포탈에 공인IP, 58080포트 접속

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a1f16857-a4c2-404d-9ca0-291bfa9f1497)<br>
대시보드 확인, 좌측의 설정 > [환경설정]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b0412a68-e469-4e97-a363-fee55e47ef43)<br>
환경설정 페이지에서 ZCM ID 확인

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f4ee78c1-e375-4427-b96b-cdcf954c0f2c)<br>
확인한 ZCM ID를 가지고 ZConverter 라이선스 신청<br>
라이선스 신청 페이지 : https://ziacloud.net:55051/promotion

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/76a69a69-28bc-4116-a569-c3dbc04982df)<br>
발급받은 라이선스를 설정 > [라이선스] 에서 [추가]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a22c74ad-801d-4c94-af7e-391ec7977360)<br>
추가된 라이선스 확인

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0a28030b-67ba-44bb-81d9-70c46ad3b082)<br>
좌측의 클라우드 마이그레이션 > [삼성]에서 Source VM 정보를 입력한뒤 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c386bd71-7ca6-4ffa-b511-1cb979c28c66)<br>
Target VM정보를 입력한 뒤 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/617536f3-1002-48f2-b3bf-8e6375eb76a1)<br>
사용할 라이선스를 [선택]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/44f41661-083e-430e-99ae-b6b514e1d98e)<br>
이후 포트 연결 상태와, VM의 여유공간 확인 후 [확인]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5b77eea6-ff80-419d-a363-6959a1edd584)<br>
마이그레이션이 진행됨.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/22dcbf1c-3390-4f87-a21c-3e29b4d14134)<br>
완료시 스크린샷과 같은 완료 화면을 확인 가능.
