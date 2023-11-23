<h1>VPC_Peering_Transit_Gateway</h1>
</br>
</br>
</br>

<h1>VPC_Peering</h1>
</br>
</br>
</br>

<h3>01. 생성된 VPC & 서브넷 확인</h3>

```bash
모든상품 > Networking > VPC > 서브넷

VPCdmz
    - BASTIONdmz : 192.168.0.0/24

VPCa
    - WEBa : 192.168.11.0/24
    - APPa : 192.168.12.0/24
    - Dba  : 192.168.13.0/24

VPCb
    - K8Sb : 192.168.21.0/24

VPCdr
    - BASTIONdr : 192.168.30.0/24
    - WEBdr     : 192.168.31.0/24
    - APPdr     : 192.168.32.0/24
    - Dbdr      : 192.168.33.0/24
```

</br> 

<h3>02. VPC Peering생성</h3>

```bash
모든상품 > Networking > VPC > VPC Peering > VPC Peering생성

1. VPCa, VPCb Peering (생성 후 승인 VPC에서 > 연결된 자원 > 승인필요)
요청 VPC : VPCa
승인 VPC : VPCb

2. VPCa, VPCdr Peering (생성 후 승인 VPC에서 > 연결된 자원 > 승인필요)
요청 VPC : VPCa
승인 VPC : VPCdr

```

<h3>03. VPC Peering Routing Table설정</h3>

```bash
: VPCa <--Peering--> VPCb
 Routing_Table_VPCa : 192.168.21.0/24    # VPCa -> VPCb로가는 라우팅설정
 Routing_Table_VPCb : 192.168.11.0/24, 192.168.12.0/24, 192.168.13.0/24    # VPCb -> VPCa로가는 라우팅설정
 
: VPCa <--Peering--> VPCdr
  Routing_Table_VPCa  : 192.168.30.0/24, 192.168.31.0/24, 192.168.32.0/24, 192.168.33.0/24    # VPCa -> VPCdr로 가는 라우팅 설정
  Routing_Table_VPCdr : 192.168.11.0/24, 192.168.12.0/24, 192.168.13.0/24    # VPCdr -> VPCa로 가는 라우팅 설정
```

</br>

<h1>Transit_Gateway</h1>
</br>
</br>
</br>

<h3>04. Transit Gateway 생성</h3>

```bash
모든상품 > Networking > Transit Gateway > 상품신청

Transit Gateway명 : TGce
Uplink : 사용 안함
```

</br>

<h3>05. Transit Gateway_VPC연결</h3>

```bash
모든상품 > Networking > Transit Gateway > TGW>VPC연결 > TGW-VPC 연결 생성

1. TGce, VPCdmz 연결 (연결 후 VPC에서 > 연결된 자원 > 승인필요)
Transit Gateway : TGce
VPC : VPCdmz

2. TGce, VPCa 연결 (연결 후 VPC에서 > 연결된 자원 > 승인필요)
Transit Gateway : TGce
VPC : VPCa
```

</br>

<h3>06. Transit Gateway_Routing_table설정</h3>

```bash
 : TGce <--연결--> VPCdmz
  Routung_Table_TGce_VPCdmz : 192.168.0.0/24    # TGce -> VPCdmz로 가는 라우팅 설정
  Routing_Table_VPCdmz      : 192.168.11.0/24, 192.168.12.0/24, 192.168.13.0/24    # VPCdmz -> VPCa로 가는 라우팅 설정

 : TGce <--연결--> VPCa
  Routung_Table_TGce_VPCa : 192.168.11.0/24, 192.168.12.0/24, 192.168.13.0/24    # TGce -> VPCa로 가는 라우팅 설정
  Routing_Table_VPCa      : 192.168.0.0/24    # VPCa -> VPCdmz로 가는 라우팅 설정

```

<h3>07. SSH 명령어 (원격 접속)</h3>

```bash
ssh -i /키페어/파일/위치 vmuser@호스트 주소
```

</br>

<h3>08. SCP 명령어 (파일 복제)</h3>

```bash
SCP -i /키페어/파일/위치 /로컬/파일/경로 vmuser@호스트주소:/원격/디렉토리/경로
```




















