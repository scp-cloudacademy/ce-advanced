-환경</br>
사용 OS : Ubuntu 22.04</br>
Source VM : VMware Workstation
Target VM : Samsung Cloud Platform

관리포탈 접속 포트 : 58080</br>
관리포탈 포트 : 50001,50000</br>
마이그레이션 연결 포트 : 50005</br>
/boot/efi 드라이브만 마이그레이션 해보기, local vm을 마이그레이션 해보기

<h3>Source Agent 설치</h3>

```bash
$ wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
$ tar -xzf ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
$ cd zconverter_install_source/
$ ./install.sh
```
<br/>

<h3>Target Agent 설치</h3>

```bash
$ wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
$ tar -xzf ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
$ cd zconverter_install_target/
$ ./install.sh
```
