![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/96e2acb7-c997-439a-960d-0abc1ff37003)<h1>File Storage Migration</h1>
</br>
AWS의 EFS를 SCP의 File Storage로 Migration 합니다.</br>
AWS와 SCP 사이에 VPN 연결이 필요합니다.

<h3>EFS 배포</h3>
AWS 콘솔에서 진행</br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5425e115-6b07-424a-8516-179dd4e12387)<br>
파일시스템 생성 > [사용자 지정]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e0d64ea6-cbda-4726-8fb5-23db7eb861ff)<br>
생성할 파일시스템의 이름을 입력한 뒤 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6edc9b5d-7d67-4cc0-958d-5289ce89fa58)<br>
파일시스템이 생성될 VPC 및 서브넷, 보안그룹을 설정하고 [다음]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/649e7f58-83d8-49bc-872d-2f991f6f54c9)<br>
정책 설정 단계는 디폴트로 두고 [다음]<br>
검토 및 생성 단계에서 내용 확인 후 [생성]

<h3>보안그룹 설정</h3>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9750cbe7-a4f6-4f49-a778-ec9551fa4c40)<br>
VPC > 보안그룹에서 파일시스템에 사용한 보안그룹의 설정을 확인<br>
테스트에서는 디폴트 보안그룹을 사용하여 전체 오픈되어 있으나 그렇지 않은 경우 2049 포트의 오픈이 필요.

<h3>라우팅 테이블 설정</h3>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e5eeda49-f9b0-4a6e-a163-af450564b927)<br>
인터넷 게이트웨이로 향하게 되어있는 규칙을 가상 프라이빗 게이트웨이로 변경

<h3>AWS VPN 구성</h3>
콘솔에서 진행</br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/008f09b3-b856-4d08-80db-ba806cd99953)<br>
VPC > 가상 프라이빗 게이트웨이 > 가상 프라이빗 게이트웨이 생성에서 가상 프라이빗 게이트웨이의 이름 입력 후 [생성]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f193741b-8d0b-49fd-bff3-cec17bdb3606)<br>
생성된 가상 프라이빗 게이트웨이에서 [VPC에 연결]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5344cfd8-f39d-4261-86a3-c0b67bde26b5)<br>
VPC 선택 후 [VPC에 연결]

<h3>Samsung Cloud Platform VPN 구성</h3>
콘솔에서 진행</br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/dbb976e5-1383-4321-a85b-1493020aa371)<br>
자원관리 > Networking > VPN에서 [상품 신청]<br>
VPN Gateway 이름과 Local Subnet IP대역을 입력하고 [다음]<br>
신청 정보를 확인한 뒤 [완료]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/71826a6a-566b-428f-9010-f46efdc03d24)<br>
생성된 VPN Gateway의 Public IP 주소 확인

<h3>VPN 연결 구성</h3>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/aa27cde6-463e-4275-a228-f28741f636bb)<br>
AWS 콘솔에서 VPC > 고객 게이트웨이 > 고객 게이트웨이 생성

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/10cbeac4-b3b1-45c8-86e7-93a7b553bf95)<br>
고객 게이트웨이의 이름과, Samsung Cloud Platform VPN Gateway의 Public IP주소를 입력하고 [생성]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1430d27b-bcb2-472d-8cfa-133e6c8cd82d)<br>
AWS 콘솔에서 VPC > Site to Site VPN 연결 > VPN 연결 생성

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ff50ae2a-b0e7-43a6-9c66-71d04e8cfc4b)<br>
연결의 이름을 입력하고 생성한 가상 프라이빗 게이트웨이와 고객 게이트웨이를 선택한 뒤 [생성]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/50b976cf-cc1d-470b-aa58-c7dfaf7fbc5d)<br>
생성된 연결을 선택하고 [구성 다운로드]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4bdec799-519b-44e4-8f4d-07a01f84729e)<br>
다음과 같이 선택한 뒤 [다운로드]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b8c2a064-5ed1-4059-8be2-3a1d68b35c33)<br>
다운로드 받은 구성 파일을 토대로 Samsung Cloud Platform에서 연결 진행.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/833cfde5-37a7-41c0-a0bc-8a99bed795a9)<br>
Samsung Cloud Platform에서 자원관리 > Networking > VPN > VPN Tunnel > [상품신청]<br>
AWS의 VPN 구성파일에서 정보를 확인하여 입력. (Ctrl+F 활용)<br>
정보 입력 후 [다음] 및 신청정보 검토 후 [완료]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ba0c5f8e-5762-4983-b5a3-5033c1d1ba0a)<br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3a7091a4-a6a4-4fef-b532-85749630c756)<br>
결과 상태 up으로 올라온 Samsung Cloud Platform VPN Tunnel과 AWS Site to Site 연결을 확인


<h3>VM 배포 및 설정</h3>

File Storage Migration 작업을 위해 Samsung Cloud Platform VPCdmz에 Linux Virtual Server 배포

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c5f092fd-d6f1-45a7-8809-fbc25af07bfd)<br>
자원관리 > Netwroking > VPN 에서 Local Subnet에 File Storage Migration 작업을 위해 배포한 Virtual Server 추가

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9b9b6df9-241a-4711-b7dd-12a7cb48822a)<br>
추가된 Virtual Server의 IP 및 MAX 확인<br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9294a0b1-8708-4e06-a8b9-ac89895f8764)<br>
이후 배포한 Virtual Server에 접속하여 IP정보 확인, VPN에서 확인한것과 동일한 MAC 주소를 가진 네트워크 어댑터를 확인.

```bash
ip addr
```

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f3ad567c-e0a9-4511-b7ac-06f3e8330999)<br>
확인한 MAC과 동일한 주소를 가진 네트워크 어댑터 이름의 설정파일 작성

```bash
sudo vi /etc/sysconfig/network-scripts/ifcfg-[네트워크어댑터이름]
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

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/377d1038-2a4b-4c06-bf4e-b0d86f14b952)<br>
라우팅 설정 추가

```bash
sudo vi /etc/sysconfig/network-scripts/route-[네트워크어댑터이름]
```

```bash
[AWS VPN 로컬 주소공간] via [확인한 IP 정보의 게이트웨이]
```

<h3>File Storage 배포 및 마운트</h3>

```bash
sudo yum install nfs-utils -y    # nfs 유틸 설치
sudo mkdir /efs                  # 마운트할 dir 생
sudo mount -t nfs -o vers=3,noresvport [FileStorage마운트정보] [마운트경로]
```

<h2>Migration</h2>
<h3>EFS 마운트</h3>
EFS에서 [연결]에서 확인할 수 있는 마운트 정보로 마운트

<h3>rsync 실행</h3>

```bash
$ rsync -avzh --delete [source] [destination]
```
