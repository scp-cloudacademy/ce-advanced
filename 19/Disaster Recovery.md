<h1>Disaster Recovery</h1>

<h3>Virtual Server Backup</h3>
가상머신 백업 Service를 생성<br>
자원관리 > Storage > Backup > 상품 신청을 클릭

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

<h3>DBaaS Read Replica</h3>
