<h1>Disaster Recovery</h1>

<h3>Virtual Server Backup</h3>
가상머신 백업 Service를 생성<br>
자원관리 > Storage > Backup > [상품신청] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/166a37fc-b920-4863-9a4f-cde28a80b5d2)<br>
Backup명, Backup 대상, 보관기간 및 Backup 스케쥴을 지정하고 DR사용을 체크한 뒤 Backup을 생성.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4bce883c-afdf-4941-9ccf-0f980b050d38)<br>
DR사용을 체크하여 생성된 Backup Service는 원본과 DR복제본이 생성됨.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0eab2b92-9a97-474e-ab29-9d5c9c0a2d13)<br>
원본에서 Backup이 실행되어 Backup 파일이 생성되면 Backup 완료 후 1시간 이내로 DR복제본에도 Backup 파일이 생성됨.

<h3>Virtual Server Backup DR복구</h3>

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e12588de-0088-4b76-ba57-66926f6fe8a1)<br>
DR복제본을 통한 복구를 실행할 때 DR복제본의 Backup 파일 우측의 [복구] 버튼을 클릭.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/088d1bc8-2a6c-4539-9bea-b8b3b31fdf7d)<br>
DR복제본 Backup 파일로 Virtual Server를 복구할 때 VM명, 네트워크 설정을 확인한 뒤 [확인]을 눌러 복구할 수 있습니다.

원본 Backup 파일로 복구할 경우에는 네트워크 설정 없이 Backup 대상 서버와 동일한 위치에 복구됩니다.

<h3>Object Storage DR 동기화</h3>
자원관리 > Storage > Object Storage > [상품신청] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6626e220-3f18-44e4-90d1-ae6966819d56)<br>
위치를 확인하고 버킷명을 입력, 버전관리를 설정한 뒤 Object Storage를 생성.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c0410784-2a4b-478b-a9e3-dddf2207a9e0)<br>
각기 다른 위치에 Object Storage를 2개 생성하고 원본이 될 Object Storage를 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c158457f-3060-4c7f-975e-70b31bb889eb)<br>
상세정보창 상단의 [DR동기화] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/337c75f2-6bda-4eb5-b72e-1f42c19b6a8f)<br>
DR복제본을 저장할 Object Storage를 선택하고 [확인]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d975aa2f-2e9d-426c-8720-3c7f166b56c0)<br>
상세정보창 하단에서 DR동기화 상태를 확인할 수 있음

<h3>DBaaS Read Replica</h3>

 - 시작에 앞서 해당 과정은 원본 DBaaS가 생성된 VPC와 다른 위치의 DR용 VPC가 Peering 연결이 된 상태에서 진행할 수 있습니다.

자원관리 > Database > MySQL(DBaaS)에서 원본 DB를 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4fc8c72a-ae41-4820-9676-47cb7fc23540)<br>
상세정보창 우측의 ...을 클릭하여 [Replica 구성] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0e274926-1dde-4e71-ac3d-8791663db6ad)<br>
필수정보를 입력하고 반드시 Other-Region 설정을 체크하여 위치를 확인한 뒤 생성

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/935db186-2f8b-4f77-8edf-5ca1ed8769c1)<br>
다른 위치에 생성된 Replica를 확인
