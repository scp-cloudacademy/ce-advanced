# 1. Mysql(DBaaS) 고가용성 구성하기
#### Configuration
```
version: 8.0.33
서버명: dba
클러스터명: dbcla
* 고가용성: 체크
database명: cosmetic
user: vmuser
pw: 사용자 지정
DataBase Port번호: 2866 (default)
```
# 2. Security Group 규칙 추가
1) [BastionSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/Bastion.xlsx)
2) [AppSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/app.xlsx)
3) [DBSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/db.xlsx)

# 3. 워크벤치로 테스트 통신
기존 데이터 베이스 자료를 새로 생성한 DBaaS에 마이그레이션 실시
VIP정보를 확인 후, 접속한다.

### DNS 변경
DB DNS의 레코드 설정값을 DBaaS VIP 정보로 변경한다.
