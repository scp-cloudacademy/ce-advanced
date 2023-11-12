<h1>VPC_Peering_Transit_Gateway</h1>
</br>
</br>
</br>

<h3>1. VPC 생성</h3>

```bash
VPCdmz (WEST)
VPCa   (WEST)
VPCb   (WEST)
VPCdr  (EAST-1)
```

</br>

<h3>2. Subnet 생성</h3>

```bash
BASTIONdmz (VPCdmz, Public, 192.168.0.0/24)
WEBa       (VPCa, Private, 192.168.11.0/24)
K8Sb       (VPCb, Private, 192.168.21.0/24)
VPCdr      (VPCdr, Private, 192.168.31.0/24)
```
</br>

<h3>3. Internet Gateway 생성</h3>

```bash
IGW_VPCdmz  (VPCdmz)
```

</br>

<h3>4. Security Group (22 Port Open)</h3>

```bash
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
```

</br>

<h3>5. Virtual Server</h3>

```bash
BASTIONdmz  (VPC : VPCdmz Subnet : BASTIONdmz SG : BASTIONdmz)
WEBa        (VPC : VPCa   Subnet : WEBa       SG : WEBa)
K8Sb        (VPC : VPCb   Subnet : K8Sb       SG : K8sb)
WEBdr       (VPC : VPCdr  Subnet : K8sb       SG : WEBdr)
```

</br>

<h3>6. VPC Peering</h3>

```bash
: VPCdmz <--Peering--> VPCa
  Routing_Table_VPCdmz (192.168.11.0/24), Routing_Table_VPCa (192.168.0.0/24)
: VPCdmz <--Peering--> VPCdr
  Routing_Table_VPCdmz (192.168.31.0/24), Routing_Table_VPCdr (192.168.0.0/24)
```

</br>

<h3>7. Transit Gateway 생성</h3>

```bash
TGce    (WEST)
TGce01  (EAST-1)
```

</br>

<h3>8. Transit Gateway Peering</h3>

```bash
: TGce   <--TGW_VPC_연결--> VPCdmz, VPCa, VPCb
    Routung_Table_TGce_VPCdmz (192.168.0.0/24), Routing_Table_VPCdmz (192.168.11.0/24, 192.168.21.0/24, 192.168.31.0/24)
    Routung_Table_TGce_VPCa (192.168.11.0/24), Routing_Table_VPCa (192.168.0.0/24, 192.168.21.0/24, 192.168.31.0/24)
    Routung_Table_TGce_VPCb (192.168.21.0/24), Routing_Table_VPCb (192.168.0.0/24, 192.168.11.0/24, 192.168.31.0/24)

: TGce01 <--TGW_VPC_연결--> VPCdr
    Routung_Table_TGce_VPCdr (192.168.31.0/24), Routing_Table_VPCdr (192.168.11.0/24, 192.168.11.0/24, 192.168.21.0/24)
```

</br>

<h3>SSH 명령어 (원격 접속)</h3>

```bash
ssh -i /키페어/파일/위치 vmuser@호스트 주소
```

</br>

<h3>SCP 명령어 (파일 복제)</h3>

```bash
SCP -i /키페어/파일/위치 /로컬/파일/경로 vmuser@호스트주소:/원격/디렉토리/경로
```




















