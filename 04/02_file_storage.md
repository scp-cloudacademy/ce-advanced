
<h1>File Storage Migration</h1>
</br>

## Prerequisition
- Create AWS EFS and store contents</br>
- Establish VPN connection between Samsung Cloud Platform and AWS.

* These prerequisition will not be covered at the lecture. To run this part, you need to complete section 1. Create AWS EFS and 2. Establish VPN connection between Samsung Cloud Platform and AWS.

<h3>1. Create AWS EFS</h3>
In AWS Console, Create File System > Customize </br>

<img width="601" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5146b79a-73f3-4783-a26d-83de46cee360">

Type Name of File system like: efsce and click [Next] </br>
<img width="1641" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/877d31e9-d994-404a-a664-646e1ede6341">

Configure VPC, Subnet and Security Group and click [Next] </br>
<img width="1313" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ac2d5872-74fa-4e22-b6e1-92ff059ba289">

Leave File system policy without change and click [Next] </br>
<img width="1311" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/95d0fef3-876b-4734-8aa7-b69e101fa8b8">

Review and Create</br>
<img width="1341" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c3eb1893-5061-4a15-971a-a7f647131c96">
<img width="1335" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/41a65904-28d8-4372-bffd-acf996889c97">


If you use default security group(open all), you can pass configuring security group.

If you use your own security group, you need to allow 2049 port.

<img width="1430" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d42de4be-a768-4ad1-af84-48c09772e8e4">


<h3>2. Establish VPN connection between Samsung Cloud Platform and AWS</h3>

VPC > Virtual Private Gateway > Create Virtual Private Gateway  [생성]
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/008f09b3-b856-4d08-80db-ba806cd99953)<br>


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

<h3>Configure route table</h3>
Change route table to forward outbound traffic for VPN Gateway 
<img width="1429" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a3f1c242-f51b-4249-bc0b-37fd188f7a42">


인터넷 게이트웨이로 향하게 되어있는 규칙을 가상 프라이빗 게이트웨이로 변경


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

```bash
sudo systemctl restart network
```
Samsung Cloud Platform에서 File Storage 배포

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/253444b7-80bb-4c8b-96ec-c2e566977984)<br>
자원관리 > Storage > File Storage(new) > 상품신청<br>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7c35e1e7-2c3c-4f6e-8783-7846e5fd3347)<br>
생성된 File Storage의 상세정보에서 적용서버란의 [수정] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9f4e7f41-1168-4102-b218-239ae7121fbf)<br>
Migration에 사용할 Virtual Server를 선택하여 [확인]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/835f5984-b56b-4ce3-a5fb-e35db4a73901)<br>
적용서버에 등록된 것을 확인하고 마운트 정보를 확인, 이는 Virtual Server에 마운트할때 사용됨

```bash
sudo mkdir /files                  # 마운트할 dir 생성
sudo mount -t nfs -o vers=3,noresvport [FileStorage마운트정보] [마운트경로]
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3288c3f5-24aa-4d2b-8529-3d5765bf3170)<br>
마운트된 것을 확인

<h2>Mount</h2>
<h3>EFS 마운트</h3>

마운트 전 필요한 유틸 및 마운트 위치 생성

```bash
sudo yum install nfs-utils -y    # nfs 유틸 설치
sudo mkdir /efs                  # 마운트할 dir 생성
```

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/45db65fc-647d-4048-9007-ab0b98c8e707)<br>
EFS에서 [연결]에서 확인할 수 있는 마운트 정보 확인

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/375b56fe-1087-45ef-9235-ff90e140bd74)<br>
마운트 결과

<h3>Samsung Cloud Platform File Storage 배포 및 마운트</h3>


<h3>rsync 실행</h3>

```bash
sudo yum install rsync -y
sudo rsync -avzh --delete [source경로] [destination경로]
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/dacbd225-87ba-4a0d-b0e0-c34c2adfa16c)<br>
명령어를 통해 Migration을 실행.
