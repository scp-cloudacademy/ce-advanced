<h1>File Storage Migration</h1>
</br>
AWS의 EFS를 SCP의 File Storage로 Migration 합니다.</br>
AWS와 SCP 사이에 VPN 연결이 필요합니다.

<h2>AWS</h2>
<h3>EFS 배포</h3>
콘솔에서 진행</br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5425e115-6b07-424a-8516-179dd4e12387)<br>
파일시스템 생성 > [사용자 지정]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e0d64ea6-cbda-4726-8fb5-23db7eb861ff)<br>
생성할 파일시스템의 이름을 입력한 뒤 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6edc9b5d-7d67-4cc0-958d-5289ce89fa58)<br>
파일시스템이 생성될 VPC 및 서브넷, 보안그룹을 설정하고 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/649e7f58-83d8-49bc-872d-2f991f6f54c9)<br>
정책 설정 단계는 디폴트로 두고 [다음]
검토 및 생성 단계에서 내용 확인 후 [생성]

<h3>보안그룹 설정</h3>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9750cbe7-a4f6-4f49-a778-ec9551fa4c40)<br>
VPC > 보안그룹에서 파일시스템에 사용한 보안그룹의 설정을 확인
테스트에서는 디폴트 보안그룹을 사용하여 전체 오픈되어 있으나 그렇지 않은 경우 2049 포트의 오픈이 필요.


<h3>VPN 구성</h3>
콘솔에서 진행</br>

<h2>SCP</h2>
<h3>VPN 구성</h3>
콘솔에서 진행</br>

<h3>VM 배포 및 설정</h3>
VPN 상세에서 Local Subnet 추가 후 IP 및 MAC 확인</br>
IP정보 확인

```bash
$ ip addr
```
콘솔에서 확인한 MAC과 동일한 주소를 가진 네트워크 어댑터 확인 설정파일 작성

```bash
$ vi /etc/sysconfig/network-scripts/ifcfg-[네트워크어댑터이름]
```
설정파일에 입력

```bash
TYPE=Ethernet
BOOTPROTO=static
IPADDR=[확인한 IP 정보]
PREFIX=24
NAME=[네트워크어댑터이름]
DEVICE=[네트워크어댑터이름]
ONBOOT=yes
```
라우팅 설정 추가

```bash
vi etc/sysconfig/network-scripts/route-[네트워크어댑터이름]
```

```bash
[AWS VPN 로컬 주소공간] via [확인한 IP 정보의 게이트웨이]
```

<h3>File Storage 배포 및 마운트</h3>

```bash
$ yum install nfs-utils -y
$ mount -t nfs -o vers=3,noresvport [FileStorage마운트정보] [마운트경로]
```

<h2>Migration</h2>
<h3>EFS 마운트</h3>
EFS에서 [연결]에서 확인할 수 있는 마운트 정보로 마운트

<h3>rsync 실행</h3>

```bash
$ rsync -avzh --delete [source] [destination]
```
