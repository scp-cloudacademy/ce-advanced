#### 1. Custom Image 생성하기

기존에 생성한 웹, 앱 virtual Ser의 Custom Image를 생성헙니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/db6906f5-3441-402f-b8d4-3e213d978645)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/731b873a-cd29-49d4-998a-7b6ca7f6eb36)
이미지 명을 정하고, 완료를 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3b571056-c64f-412d-8746-0f5fcc1279e6)
</br>완료를 누르고 나면 위와같이, custom Image가 생성됨을 확인할 수 있습니다.

#### 2. Costom Image를 이용한 VM 만들기

모든상품 ▶ virtual Server ▶ 상품신청을 클릭합니다.</br>

이미지 선택 시, Custom을 클릭하고 생성한 custom Image를 선택후 다음버튼을 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e6287b52-2df7-48a0-9acc-7d8e99448a5c)
VM 신청정보를 입력하고 완료를 누릅니다..</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ab5286ef-8edd-4c4d-bc05-c7059208afae)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5cdbd984-3cf2-4a31-bd36-88c0b0b7eef3)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9dee6a66-5891-4496-be65-e57550f732e7)
</br> 모든 과정이 끝난 후 custom image로 생성된 vm을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/66b04752-5b1b-42fc-9663-867a2a5b06d2)


#### 3.  LoadBalancer 

##### 3.1 서버그룹 생성하기

기존에 생성한 서버와 custom image로 생성한 두개의 서버를 그룹으로 묶은 후서비스 포트를 설정 후 다음버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b8c42563-6133-4f77-932b-06520535562a)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/48291eed-fa84-4f4a-be93-c13254ba8974)
모든 설정 확인 후 완료를 누르면 서버그룹이 생성됨을 확인할 수 있습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c292227d-713b-46b5-8036-a10c1eaeefdf)

##### 3.2 LB서비스 생성하기
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c87920a5-5528-4c5e-a8d5-867c62e7e796)
서비스명을 정하고 서비스 포트는 그룹 생성 시, 사용한 포트를 넣습니다.</br>
서버그룹은 미리 생성한 그룹으로 설정을 하과 다음버튼을 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/742bd48e-7456-4370-af98-67830064f6ef)
신청정보를 확인 후 완료를 눌러 서비스를 생성해 줍니다.</br>
서비스가 생성이 되고 좀 기다리면 상태가 up으로 변경됨을 확인 할 수 있습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b176ac03-ad3c-4934-bf47-d2268c7864c4)
상세정보를 확인해보면 서버상탱에 2개의 서버상태가 UP으로 되어있음을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e5512877-dde9-41a5-a790-0f3741f23f75)


