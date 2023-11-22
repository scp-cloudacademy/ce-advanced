<h1>ZConverter</h1>

- 환경 </br>
사용 OS : CentOS 7.8 </br>
Source VM : VMware Workstation </br>
Target VM : Samsung Cloud Platform </br>

- 사용 PORT </br>
관리포탈 사용 포트 : 58080</br>
관리포탈 포트 : 50001,50000</br>
마이그레이션 포트 : 50005</br>

<h3>Source Agent 설치</h3>


```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_source/
./install.sh
```
<br/>

<h3>Target Agent 설치</h3>

```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_target/
./install.sh
```

<h3>ZConverter</h3>
