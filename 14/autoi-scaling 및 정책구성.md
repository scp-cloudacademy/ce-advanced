### 1. launch Configuration 생성
오토스케일용 wwb, app 서버의 커스텀 이미지를 생성해줍니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/114fb95c-7b25-497d-a1ab-943b66d2e6c1)
생성이 끝이나면 Launch Configuration 생성합니다.</br>
모든상품 ▶ Auto-Scaling ▶ Launch Configuration ▶ LC 생성을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/537cfa12-7e54-4ce6-ad21-da582f84c3ee)
생성한 커스텀 이미지를 선택후 다음응 클릭해 줍니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/445983ba-e7f7-4030-a063-a958a326e79a)
필수정보 입력 후 완료를 클릭하면 생성이 완료가 됩니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/76e60076-9642-4ff6-8065-97e8c88767e7)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b0186486-70f0-4c85-8bd4-6fb287aa18c8)

### 2. Auto-Scaling 생성하기
로드밸런서 생성 전, Auto-Scale에 적용할 LB서비스를 먼저 생성합니다.</br>
이전실습과 동일한 과정으로 생성하면 되고, 차이점이 있다면 서버그룹은 미지정으로 하고 생성을 합니다.</br>
모든상품 ▶ Auto-Scaling ▶ 상품신청을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/84d12a21-a026-442c-8086-aedaef7d0eb5)
생성한 Launch Configuration을 선택 후 다음버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/720d3df1-d6f7-49c7-bd2c-484e46b2038a)
필수정보를 입력하고 다음을 클릭합니다.</br>
서버수는 최소 2대, 목표 2대, 최대 4대로 지정을하고, LoadBalancer에 사용체크를 하고, 미리 생성해둔 LB서비스를 지정해 줍니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/762244cd-8182-48aa-9d10-a69b94bb0fc1)
다음으로 넘어가면 Scaling 정책, 스케쥴, 알림설정등이 있지만, 추후 추가할 예정이므로, 나중에 설정을 선택 후 다음으로 넘어갑니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/37600344-3e6b-41e8-9b20-b774aa1f8d13)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/64116bbb-4979-4b38-96e7-80e4772707b2)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e9b77a1a-c6ab-409f-97f3-08fec503844f)
신청정보를 확인 후 완료를 눌러줍니다. 그리고 나면 신청한 오토 스케일링을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a936926c-6e34-47f0-a096-74b1b3bec23b)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/04e9bdf5-58fc-48f8-ab29-77a64b8b2371)

### 3. Saling 정책
##### 3.1 Scale-Out 정책
생성한 오토스케일의 상세정보에서 정책탭을 누르고, 정책추가를 눌러줍니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/cbf1765f-6268-4c3a-9086-d7f4053fea1a)
실행조건을 설정하고 확인을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/12d88d5e-4686-4f7b-8ee0-77ec6ac53633)
생성이 되고, 시간이 지나면 scale-out상태로 변경되며, virtual Server탭을 클릭하면, 서버 대수가 지정한 대 수만큼 늘어남을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7af5e7ad-58bf-4a12-be06-a92d61cec342)

##### 3.2 Scale-In 정책
서버가 정책에 맞게 생성됨을 확인하고 이제, 줄어드는 정책을 생성합니다. 정책을 생성하기 전, scale-out 정책은 삭제를 해줍니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/dcecbdec-133d-4cfe-8f86-fc970119589c)
정책이 삭제가 되면 이번엔 Scale-in 정책을 설정해 줍니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8491bf0f-b7dc-405e-b455-c29bd8814b5b)
완료를 눌러 생성이 됨을 확인하고, 시간이 지나면, virtual server수가 감소함을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/2077a6bb-9acd-47de-a140-e65526994e91)
일정 시간이 되면 최소 대수만 남은것을 확인할 수 있습니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/efa0e7ac-4536-4b02-94fb-50b94a2677aa)




