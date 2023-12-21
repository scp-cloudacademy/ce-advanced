# VPC Peering and Transit Gateway
</br>


## 01. Create Virtual Servers to test connection

Virtual Server : bastiondmz
VPC : VPCdmz
Subnet : BASTIONdmz (192.168.0.0/24)
Security Group : BASTIONdmzSG

Virtual Server : weba1
VPC : VPCa
Subnet : WEBa (192.168.11.0/24)
Security Group : WEBaSG

Virtual Server : b-testvm
VPC : VPCb
Subnet : K8Sb (192.168.21.0/24)
Security Group : K8SbSG

Virtual Server : bastiondr
VPC : VPCdr
Subnet : BASTIONdr (192.168.30.0/24)
Security Group : BASTIONdrSG

</br>

## 02. Create VPC Peering


```bash
All products > Networking > VPC > VPC > VPC Peering > VPC Peering 

1. VPCa, VPCb Peering (in VPC console > connected resources > approve)
request VPC : VPCa
approval VPC : VPCb

2. VPCa, VPCdr Peering (in VPC console > connected resources > approve)
request VPC : VPCa
approval VPC : VPCdr

```

</br>

## 03. VPC Peering Routing Table

```bash
: VPCa <--Peering--> VPCb
 Routing_Table_VPCa : 192.168.21.0/24    # Routing for VPCa -> VPCb
 Routing_Table_VPCb : 192.168.11.0/24    # Routing for VPCb -> VPCa
 
: VPCa <--Peering--> VPCdr
  Routing_Table_VPCa  : 192.168.30.0/24    # Routing for VPCa -> VPCdr
  Routing_Table_VPCdr : 192.168.11.0/24    # Routing for VPCdr -> VPCa
```

</br>

## 04. Create Transit Gateway

</br>


```bash
All products > Networking > Transit Gateway > Request

Transit Gateway name : TGce
Uplink : not use
```

</br>

## 05. Associate Transit Gateway and VPC

```bash
All products > Networking > Transit Gateway > TGW > VPC connection > TGW-VPC connection

1. TGce, VPCdmz connection (in VPC console > connected resources > approve)
Transit Gateway : TGce
VPC : VPCdmz

2. TGce, VPCa connection (in VPC console > connected resources > approve)
Transit Gateway : TGce
VPC : VPCa

```

</br>

## 06. Configure Transit Gateway Routing_table

```bash
 : TGce <--connection--> VPCdmz
  Routing_Table_TGce_VPCdmz : 192.168.0.0/24     # Routing for TGce -> VPCdmz
  Routing_Table_VPCdmz      : 192.168.11.0/24    # Routing for VPCdmz -> VPCa

 : TGce <--connection--> VPCa
  Routung_Table_TGce_VPCa : 192.168.11.0/24    # Routing for TGce -> VPCa
  Routing_Table_VPCa      : 192.168.0.0/24     # routing for VPCa -> VPCdmz
```

</br>

## 07. Add Security Group rule

```bash
All products > Networking > Security Group

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
