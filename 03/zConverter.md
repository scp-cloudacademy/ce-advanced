<h1>ZConverter</h1>

- 환경 </br>
사용 OS : CentOS 7.8 </br>
Source VM : VMware Workstation </br>
Target VM : Samsung Cloud Platform </br>

- 사용 PORT </br>
관리포탈 사용 포트 : 58080</br>
Agent 확인 포트 : 50001,50000</br>
마이그레이션 포트 : 50005</br>

<h3>Source Agent 설치</h3>

```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_source/
./install.sh
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/de093b96-737b-43ff-aae8-7aac1e811fad)
Enter

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a4c44cde-37f1-48ac-bf31-a7a384664754)
2. ZCM 선택

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6b3d140d-4c57-41fc-b1ed-c9ccb62ae9af)
관리포탈 IP 입력

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ae5e605d-73a5-4d6f-a480-648eecace0fe)
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
