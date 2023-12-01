#### 1. Custom Image 생성하기
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f37235d1-a9c2-4d1e-82ce-bf17bb157faa)

기존에 생성한 웹, 앱 virtual Ser의 Custom Image를 생성합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/db6906f5-3441-402f-b8d4-3e213d978645)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/731b873a-cd29-49d4-998a-7b6ca7f6eb36)
이미지 명을 정하고, 완료를 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3b571056-c64f-412d-8746-0f5fcc1279e6)
</br>완료를 누르고 나면 위와같이, custom Image가 생성됨을 확인할 수 있습니다.

#### 2. Costom Image를 이용한 VM 만들기

모든상품 ▶ virtual Server ▶ 상품신청을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6e7f8d97-c695-4e10-869f-bb32a04612fa)
이미지 선택 시, Custom을 클릭하고 생성한 custom Image를 선택후 다음버튼을 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e6287b52-2df7-48a0-9acc-7d8e99448a5c)
VM 신청정보를 입력하고 완료를 누릅니다..</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ab5286ef-8edd-4c4d-bc05-c7059208afae)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5cdbd984-3cf2-4a31-bd36-88c0b0b7eef3)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9dee6a66-5891-4496-be65-e57550f732e7)
</br> 모든 과정이 끝난 후 custom image로 생성된 vm을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/66b04752-5b1b-42fc-9663-867a2a5b06d2)


#### 3.  LoadBalancer 

##### 3.1 LoadBalancer 생성하기
서버의 부하분산을 위해 로드밸런서를 생성합니다.</br>
모든상품 ▶ Networking ▶ Loadbalancer ▶ 상품신청을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7b794a96-cc21-4966-bda1-53a685b7e839)
로드밸런서 명을 정하고, 크기 IP대역을 설정 후. 가용여부를 체크합니다.</br>
Firewall 사용은 모두 해제를 합니다. 모든 설정이 끝나면 다음 버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d8df3008-3c41-4c8e-8e22-2eb9eaa32586)
신청정보 확인 후 완료버튼을 눌러줍니다. 
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/35a8607a-b007-4dcd-8a95-089b1c7a5b51)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/02d64f09-fbe5-49db-a7b4-2c99e3dd3c79)




##### 3.2 서버그룹 생성하기

생성된 로드밸런서의 상세정보에서 연결된 자원버튼을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f3b7459e-e47b-4465-9686-7048d56dfb88)
연결된 자원에서 서버그룹 생성을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5c8e1c2c-d813-4fe0-8c22-0ac7fcf25bd7)
서버그룹명을 입력하고 대상서버는 그룹하고자 하는 서버를 추가해줍니다 (ex)appa1, appa2 </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b8c42563-6133-4f77-932b-06520535562a)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/48291eed-fa84-4f4a-be93-c13254ba8974)
모든 설정 확인 후 완료를 누르면 서버그룹이 생성됨을 확인할 수 있습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c292227d-713b-46b5-8036-a10c1eaeefdf)

##### 3.3 LB서비스 생성하기
서비스명을 정하고 서비스 포트는 그룹 생성 시, 사용한 포트를 넣습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c87920a5-5528-4c5e-a8d5-867c62e7e796)
서버그룹은 미리 생성한 그룹으로 설정을 하과 다음버튼을 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/742bd48e-7456-4370-af98-67830064f6ef)
신청정보를 확인 후 완료를 눌러 서비스를 생성해 줍니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7f84aca0-3038-4392-b2ee-8604215bb186)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e09fb85a-c258-4744-ad5d-5dd42a316b3d)
서비스 상태가 완료가 되면 Active상태로 되었다가 시간이 조금 지나면, up 상태로 활성화 됩니다..
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8836b9ca-feb2-4cd5-8c13-96334a15428c)
서비스 상세정보를 보면 설정한 포트와 함께, 서버그룹에 포함된 2개의 서비스 상태가 up임을 확인할 수 있습니다.



