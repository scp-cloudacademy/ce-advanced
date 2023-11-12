1. VPC
  VPCdmz (WEST)
  VPCa   (WEST)
  VPCb   (WEST)
  VPCdr  (EAST-1)

2. Subnet
  BASTIONdmz (VPCdmz, Public, 192.168.0.0/24)
  WEBa       (VPCa, Private, 192.168.11.0/24)
  K8Sb       (VPCb, Private, 192.168.21.0/24)
  VPCdr      (VPCdr, Private, 192.168.31.0/24)

3. Internet Gateway
  IGW_VPCdmz  (VPCdmz)

4. Security Group (22 Port Open)
  BASTIONdmz
    - Inbound   : (192.168.11.0/24, 192.168.21.0/24, 192.168.31.0/24)
    - OUTbound  : (192.168.11.0/24, 192.168.21.0/24, 192.168.31.0/24)
  WEBa
    - Inbound   : (192.168.0.0/24, 192.168.21.0/24, 192.168.31.0/24)
    - OUTbound  : (192.168.0.0/24, 192.168.21.0/24, 192.168.31.0/24)
  K8Sb
    - Inbound   : (192.168.0.0/24, 192.168.11.0/24, 192.168.31.0/24)
    - OUTbound  : (192.168.0.0/24, 192.168.11.0/24, 192.168.31.0/24)
  WEBdr
    - Inbound   : (192.168.0.0/24, 192.168.11.0/24, 192.168.21.0/24)
    - OUTbound  : (192.168.0.0/24, 192.168.11.0/24, 192.168.21.0/24)

5. Virtual Server
  BASTIONdmz  (VPC : VPCdmz Subnet : BASTIONdmz SG : BASTIONdmz)
  WEBa        (VPC : VPCa   Subnet : WEBa       SG : WEBa)
  K8Sb        (VPC : VPCb   Subnet : K8Sb       SG : K8sb)
  WEBdr       (VPC : VPCdr  Subnet : K8sb       SG : WEBdr)

6. VPC Peering
  : VPCdmz <--Peering--> VPCa
    Routing_Table_VPCdmz (192.168.11.0/24), Routing_Table_VPCa (192.168.0.0/24)
  : VPCdmz <--Peering--> VPCdr
    Routing_Table_VPCdmz (192.168.31.0/24), Routing_Table_VPCdr (192.168.0.0/24)

7. Transit Gateway
  TGce    (WEST)
  TGce01  (EAST-1)

8. Transit Gateway Peering
   : TGce   <--TGW_VPC_연결--> VPCdmz, VPCa, VPCb
    Routung_Table_TGce_VPCdmz (192.168.0.0/24), Routing_Table_VPCdmz (192.168.11.0/24, 192.168.21.0/24, 192.168.31.0/24)
    Routung_Table_TGce_VPCa (192.168.11.0/24), Routing_Table_VPCa (192.168.0.0/24, 192.168.21.0/24, 192.168.31.0/24)
    Routung_Table_TGce_VPCb (192.168.21.0/24), Routing_Table_VPCb (192.168.0.0/24, 192.168.11.0/24, 192.168.31.0/24)

   : TGce01 <--TGW_VPC_연결--> VPCdr
    Routung_Table_TGce_VPCdr (192.168.31.0/24), Routing_Table_VPCdr (192.168.11.0/24, 192.168.11.0/24, 192.168.21.0/24)
   

# SSH 명령어 (원격 접속)
  ssh -i /키페어/파일/위치 vmuser@호스트 주소

# SCP 명령어 (파일 복제)
  SCP -i /키페어/파일/위치 /로컬/파일/경로 vmuser@호스트주소:/원격/디렉토리/경로



















