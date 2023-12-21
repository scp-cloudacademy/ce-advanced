<h1>VPC_Peering_Transit_Gateway</h1>
</br>
</br>
</br>

<h1>사전준비</h1>
</br>
</br>
</br>

<h3>사용할 가상머신 확인및 생성</h3>

```bash
모든상품 > Compute > Virtual Server > Virtual Server > 상품신청

#(이전차시 생성 확인)
Virtual Server : bastiondmz
VPC : VPCdmz
Subnet : BASTIONdmz (192.168.0.0/24)
Security Group : BASTIONdmzSG

#(Virtual Server 배포, WEST-1)
Virtual Server : weba1
VPC : VPCa
Subnet : WEBa (192.168.11.0/24)
Security Group : WEBaSG

#(Virtual Server 배포, WEST-1)
Virtual Server : b-testvm
VPC : VPCb
Subnet : K8Sb (192.168.21.0/24)
Security Group : K8SbSG

#(Virtual Server 배포, EAST-1)
Virtual Server : bastiondr
VPC : VPCdr
Subnet : BASTIONdr (192.168.30.0/24)
Security Group : BASTIONdrSG
```

</br>

<h1>VPC_Peering</h1>

</br>

<h3>01. VPC Peering 생성</h3>

```bash
모든상품 > Networking > VPC > VPC > VPC Peering > VPC Peering 생성

1. VPCa, VPCb Peering (생성 후 승인 VPC에서 > 연결된 자원 > 승인필요)
요청 VPC : VPCa
승인 VPC : VPCb

2. VPCa, VPCdr Peering (생성 후 승인 VPC에서 > 연결된 자원 > 승인필요)
요청 VPC : VPCa
승인 VPC : VPCdr

```

</br>

<h3>02. VPC Peering Routing Table설정</h3>

```bash
: VPCa <--Peering--> VPCb
 Routing_Table_VPCa : 192.168.21.0/24    # VPCa -> VPCb로가는 라우팅설정
 Routing_Table_VPCb : 192.168.11.0/24    # VPCb -> VPCa로가는 라우팅설정
 
: VPCa <--Peering--> VPCdr
  Routing_Table_VPCa  : 192.168.30.0/24    # VPCa -> VPCdr로 가는 라우팅 설정
  Routing_Table_VPCdr : 192.168.11.0/24    # VPCdr -> VPCa로 가는 라우팅 설정
```

</br>

<h1>Transit_Gateway</h1>

</br>

<h3>03. Transit Gateway 생성</h3>

```bash
모든상품 > Networking > Transit Gateway > 상품신청

Transit Gateway명 : TGce
Uplink : 사용 안함
```

</br>

<h3>04. Transit Gateway_VPC연결</h3>

```bash
모든상품 > Networking > Transit Gateway > TGW>VPC 연결 > TGW-VPC 연결 생성

1. TGce, VPCdmz 연결 (연결 후 VPC에서 > 연결된 자원 > 승인필요)
Transit Gateway : TGce
VPC : VPCdmz
Firewall 사용 : 사용 안함
Firewall 로깅여부 : 사용 안함

2. TGce, VPCa 연결 (연결 후 VPC에서 > 연결된 자원 > 승인필요)
Transit Gateway : TGce
VPC : VPCa
Firewall 사용 : 사용 안함
Firewall 로깅여부 : 사용 안함
```

</br>

<h3>05. Transit Gateway_Routing_table 설정</h3>

```bash
 : TGce <--연결--> VPCdmz
  Routing_Table_TGce_VPCdmz : 192.168.0.0/24     # TGce -> VPCdmz로 가는 라우팅 설정
  Routing_Table_VPCdmz      : 192.168.11.0/24    # VPCdmz -> VPCa로 가는 라우팅 설정

 : TGce <--연결--> VPCa
  Routung_Table_TGce_VPCa : 192.168.11.0/24    # TGce -> VPCa로 가는 라우팅 설정
  Routing_Table_VPCa      : 192.168.0.0/24     # VPCa -> VPCdmz로 가는 라우팅 설정
```

</br>

<h3>06. Security Group 추가/수정</h3>

```bash
모든상품 > Networking > Security Group

# Security Group name : BASTIONdmzSG
Outbound : 22port (192.168.11.0/24)

# Security Group name : WEBaSG
Inbound : 22port (192.168.0.0/24)
Outbound : 22port (192.168.21.0/24, 192.168.30.0/24)

# Security Group name : K8SbSG
Inbound : 22port (192.168.11.0/24)

# Security Group name : BASTIONdrSG
Inbound : 22port (192.168.11.0/24)
```

</br>

<h3>07. 연결 테스트</h3>

```bash
1. VPCdmz > VPCa 연결
2. VPCa > VPCb 연결
3. VPCa > VPCdr 연결
```
