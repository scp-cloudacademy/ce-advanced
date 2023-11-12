<h1>File Storage Migration</h1>
</br>
AWS의 EFS를 SCP의 File Storage로 Migration 합니다.</br>
AWS와 SCP 사이에 VPN 연결이 필요합니다.

<h2>AWS</h2>
<h3>EFS 배포</h3>
<h3>VPN 구성</h3>

<h2>SCP</h2>
<h3>VPN 구성</h3>
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
