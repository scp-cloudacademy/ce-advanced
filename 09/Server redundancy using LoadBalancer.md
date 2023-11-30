#### 1. Custom Image 생성하기

기존에 생성한 웹, 앱 virtual Ser의 Custom Image를 생성한다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/fa32220d-4843-4c31-a421-fd6ecb0d7a5e)
위 그릠을 참고하여, 이미지 생성 버튼을 누른다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7adf80d5-d449-4fd1-adae-e870be3253fb)
이미지 명을 정하고, 완료를 누른다. </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c9479733-4666-4b5a-a32f-d6d138c6f63b)
모든 과정이 끝나면 위와같이 이미지가 생성이 된다.</br>
앱 이미지도 동일한 과정을 통해 이미지를 생성한다.

#### 2. Costom Image를 이용한 VM 만들기
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e024f24a-060d-48a9-8e08-ae52355ba747)
모든상품 ▶ virtual Server ▶ 상품신청을 클릭한다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4b14aebe-4376-4d10-bb17-f0886b6772a5)
이미지 선택 시, Custom을 클릭하고 생성한 custom Image를 선택후 다음버튼을 누른다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ebc773df-395f-42a5-bc9f-7e7a69248eaf)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f36abd53-1bdf-4d54-b648-3f0ab9bd82a9)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/01f05921-866d-4227-bc6c-2586294df33c)
신청정보를 입력하고 나서 확인 후 완료를 누르면 기존에 생성한 웹서버와 동일한 VM이 추가로 생성이 된다.</br>
웹,앱 서버 모두 서버를 만들고 나서 LoadBalancer 설정을 한다.

#### 3.  LoadBalancer 

##### 3.1 서버그룹 생성하기
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/83b924ea-dbf8-4fee-8629-fc29388495ae)
기존에 생성한 서버와 custom image로 생성한 두개의 서버를 그룹으로 묶은 후서비스 포트를 설정 후 다음버튼을 클릭한다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/60a23e33-0753-48c1-8099-4096edcd9995)
모든 설정 확인 후 완료를 누르면 서버그룹이 생성이 된다.</br>

##### 3.2 LB서비스 생성하기
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e4225360-2c44-4232-b8b4-c2326c701bd9)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/77518b21-f8d8-4bbf-bb15-ccacc2f792b2)
