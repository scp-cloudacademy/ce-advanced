# GSLB
</br>
</br>
</br>

## 01. Create GSLB

```bash
All products > Networking > GSLB > Request

Usage : PUBLIC
Domanin name : gslbtestce
Add connection target
 - IP : 123.37.4.75(drtest), 123.41.128.11(bastiondr)    # PUBLIC IP of servers

Setting GSLB algorithm
 - Algorithm : Ratio

Setting method to monitor resources.
 - Health check : TCP
 - Interval : 5
 - Timeout : 7
 - Probe timeout : 5
 - Service port : 80
```

</br>

## 02. IGW_Firewall

To monitor servers, it need to allow port for GSLB

```bash
All products > Networking > Firewall

FIrewall name : FW_IGW_VPCdrtest
Source IP : [Public IP shown in GSLB console]
Destination IP : 192.168.1.0/24
Protocol : TCp
Allowed port : 80
Direction : Inbound

FIrewall name : FW_IGW_VPCdr
Source IP : 112.106.155.0/24, 112.107.100.0/24
Destination IP : 192.168.30.0/24
Protocol : TCp
Allowed port : 80
Direction : Inbound

```

</br>

## 03. Add Security Group rule

To monitor servers, it need to allow port for GSLB

```bash
All products > Networking > Security Group

Security Group name : drtestSG
Direction : Inbound
Target IP : 112.106.155.0/24, 112.107.100.0/24
Protocol : TCP
Allowed port : 80

Security Group명 : BASTIONdrSG
Direction : Inbound
Target IP : 112.106.155.0/24, 112.107.100.0/24
Protocol : TCP
Allowed port : 80 
``` 
