#### 1. launch Configuration 생성
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

#### 2. Auto-Scaling 생성하기
로드밸런서 생성 전, Auto-Scale에 적용할 LB서비스를 먼저 생성합니다.</br>
이전실습과 동일한 과정으로 생성하면 되고, 차이점이 있다면 서버그룹은 미지정으로 하고 생성을 합니다.</br>
모든상품 ▶ Auto-Scaling ▶ 상품신청을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/84d12a21-a026-442c-8086-aedaef7d0eb5)
생성한 Launch Configuration을 선택 후 다음버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/720d3df1-d6f7-49c7-bd2c-484e46b2038a)

