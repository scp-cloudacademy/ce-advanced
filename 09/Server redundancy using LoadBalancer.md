#### 1. Custom Image 생성하기

기존에 생성한 웹, 앱 virtual Ser의 Custom Image를 생성한다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/db6906f5-3441-402f-b8d4-3e213d978645)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/731b873a-cd29-49d4-998a-7b6ca7f6eb36)

이미지 명을 정하고, 완료를 누른다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3b571056-c64f-412d-8746-0f5fcc1279e6)
</br>모든 과정이 끝나면 위와같이 이미지가 생성이 된다.</br>

#### 2. Costom Image를 이용한 VM 만들기

모든상품 ▶ virtual Server ▶ 상품신청을 클릭한다.</br>

이미지 선택 시, Custom을 클릭하고 생성한 custom Image를 선택후 다음버튼을 누른다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e6287b52-2df7-48a0-9acc-7d8e99448a5c)
신청정보를 입력하고 나서 확인 후 완료를 누르면 기존에 생성한 웹서버와 동일한 VM이 추가로 생성이 된다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ab5286ef-8edd-4c4d-bc05-c7059208afae)


웹,앱 서버 모두 서버를 만들고 나서 LoadBalancer 설정을 한다.

#### 3.  LoadBalancer 

##### 3.1 서버그룹 생성하기

기존에 생성한 서버와 custom image로 생성한 두개의 서버를 그룹으로 묶은 후서비스 포트를 설정 후 다음버튼을 클릭한다.</br>

모든 설정 확인 후 완료를 누르면 서버그룹이 생성이 된다.</br>

##### 3.2 LB서비스 생성하기


