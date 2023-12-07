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
1) DBSG 3306 inbound 규칙에 들어가서, 2866포트 추가
2) BastionSG 규칙추가 192.168.13.0/24 outbound 2866포트 추가
3) AppSG 3306 outbound 규칙에서 2866포트 추가

# 3. 워크벤치로 테스트 통신
기존 데이터 베이스 자료를 새로 생성한 DBaaS에 마이그레이션 실시
### 새로운 데이터 베이스 전환
    sudo vi /etc/php.ini  #php 정보수정
    [Database]
    mysqli.host=db.cesvc.net
    mysqli.username=vmuser
    mysqli.dbname=cosmetic
    mysqli.port=2866  #포트변경

저장 후 php-mfm 재부팅 </br>
```
sudo systemctl restart php-fpm
```    

### DNS 변경
DB DNS의 레코드 설정값을 DBaaS VIP 정보로 변경한다.

    







