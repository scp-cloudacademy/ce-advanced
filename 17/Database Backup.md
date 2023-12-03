
<h1>Database Backup</h1>

<h3>Backup 구성</h3>

자원관리 > Database > MySQL(DBaaS)에서 생성되어있는 DBaaS 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6a8e8f45-6897-4722-a1d1-bed26f98bef1)<br>
상세정보에서 백업 옆의 [수정] 클릭

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4e61fd1f-880e-4273-8935-3d2f75494621)<br>
백업 [사용] 체크 후 Backup 스케줄과 보관기간 설정 후 [확인]

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0b548a1f-d214-4010-b1d0-8a2032f5ab70)<br>
백업이 설정된것을 확인

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/12a1cbbe-6e1c-4e41-b94c-6918a26aebbb)<br>
스케줄에 맞춰 Backup이 진행되면 [백업이력]에서 확인 가능

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/72ed1d93-d3c5-4ff7-87f2-24e6e9cb57fa)<br>
[Database 복구]를 클릭하여 Restore 가능

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/fbf0b32f-e153-487a-9008-559df04a3bc6)<br>
서버명 및 클러스터명을 입력하면 생성 가능

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3ae4ba02-d8b8-4e4b-b6eb-38f576661e1e)<br>
생성된 복제본은 스크린샷과 같이 확인 가능


0. VM 가비지 파일 하나
1. backup service
2. VIrtual back web
3. 백업 완료
4. web 파일 하나 지우고
5. 새 VM으로 복구, 대체
6. 데이터베이스 운영중
7. 백업 주기 살펴보고,
8. 워크벤치 데이터를 삭제
8. 백업으로 가서 백업 설정 확인
9  백업본을 보고 백업 복구
10. 백업 본 생기면,
11. 워크벤치로 가서 연결, 삭제 필드 확인
12. 필드만 가져와서
13. 복구

1. Object Storage web folder 버전 관리 설정
2. 파일 변경
3. 이전 버전 확인
4. 복구
5. Virtual Server 마운트 리뷰 스냅샷 없는 걸 확인
5. File Storage로 돌아와서 스케줄 설정 확인
6. 즉시 스냅샷 실행 
6. Virtual Server로 돌아오고, 파일을 하나 삭제
7. 스냅샷으로 들어가서 파일을 확인
8. 복구..


1. 백업서비스 DR 구성, Web, APP 설정
2. EAST 가서 백업서비스에서 복제 VM 확인
3. 가상머신 복구
4. 디알에 버킷 생성
5. 주사이트에서 디알 동기화 실행
6. 데이터베이스 서비스 리드 리플리카 리전 복제로 실행
7 데이터베이스 복제본 확인 (주로 올리는 것 테스트)
8 서비스 연결
9. 지에스엘비에 등록 테스트


