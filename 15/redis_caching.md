# MySQL Caching with Redis

  **Scenario :** Cosmetic Evolution Shoppingmall severs

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Redis(DBaaS) 

---


## Server Setup

### 1. Install php-redis

    sudo apt install php-redis

### 2. Patching Redis to PHP database source
```php
<?php
header('Content-Type: text/html; charset=UTF-8');

// Redis 설정
$redisHost = 'redis.cesvc.net';
$redisPort = 6378;
$redis = new Redis();
$redis->connect($redisHost, $redisPort);
$redis->auth('VMuser1@');

try {
    // Redis 연결 설정
    $redis = new Redis();
    $redis->connect('redis.cesvc.net', 6378);

    // 기타 Redis 작업 수행
} catch (Exception $e) {
    // 연결 에러 처리
    echo "Redis 연결 에러: " . $e->getMessage();
}

// 명령어 구분
$cmd = $_POST['cmd'];

if ($cmd == "DBConnection") {
    DBConnection();
} elseif ($cmd == "SaveDBTicket") {
    SaveDBTicket();
} elseif ($cmd == "GetListMovies") {
    GetListMovies();
} elseif ($cmd == "DeleteMovie") {
    DeleteMovie();
} elseif ($cmd == "CreateMovie") {
    CreateMovie();
} elseif ($cmd == "InitDatabase") {
    InitDatabase();
} elseif ($cmd == "DropDatabaseTable") {
    DropDatabaseTable();
} elseif ($cmd == "GetListCosmetics") {
    GetListCosmetics();
} elseif ($cmd == "OrderCosmetics") {
    OrderCosmetics();
//} elseif ($cmd == "ResetCosmeticsInventory") {
//    ResetCosmeticsInventory();
} elseif ($cmd == "InitCosmetics") {
    InitCosmetics();
}

	//Table Drop
	function DropDatabaseTable() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "DROP TABLE MOVIES";
			
			$result['success']	= mysqli_query($connect, $sql);
			$result['msg']		= "Database table droped.";
		
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	//화장품 테이블 초기화하기
	function InitCosmetics() {
		
		try {
			session_start();
			
			$inipath = php_ini_loaded_file();
			
$configVars = parse_ini_file(php_ini_loaded_file(), TRUE);
			$connect = mysqli_connect($configVars['Database']['mysql.host'], $configVars['Database']['mysql.username'], $configVars['Database']['mysql.passwd'], $configVars['Database']['mysql.dbname'], $configVars['Database']['mysql.port']) or die("DB connection Failed.");		


			
			$sql = "DROP TABLE IF EXISTS COSMETIC;";
			$pResult = mysqli_query($connect, $sql);
			
			$sql = "CREATE TABLE COSMETIC ("
			  	."`ID` varchar(7) NOT NULL,"
			  	."`TITLE` varchar(128) DEFAULT NULL,"
			  	."`INVENTORY` int DEFAULT NULL,"
			  	."PRIMARY KEY (`ID`)"
					.") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
			$pResult = mysqli_query($connect, $sql);
			
			$sql = "INSERT INTO COSMETIC VALUES ('38ABE4Q','CE Moisture Emulsion',999),('DYXZBUH','CE Moisture Serum',999),('U6FHF7A','CE Moisture Tea Lotion',999);";
			
			
			$result['success']	= mysqli_query($connect, $sql);
			$result['msg']		= "Database initialize.";
		
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
			
	}

	//데이터베이스 테이블 초기화
	function InitDatabase() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "CREATE TABLE MOVIES ("
				  ."`ID` 	  varchar(7) NOT NULL,"
				  ."`TITLE_KO` varchar(256) NOT NULL,"
				  ."`TITLE_EN` varchar(256) NOT NULL,"
				  ."`GENRE` varchar(256) DEFAULT NULL,"
				  ."`DIRECTOR` varchar(128) DEFAULT NULL,"
				  ."`RELEASE_YEAR` varchar(4) DEFAULT NULL,"
				  ."PRIMARY KEY (`ID`)"
				.") ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
			$pResult = mysqli_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('DYXZBUH','추격자','The Chaser','범죄','나홍진','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('FNZS7SB','쿵푸팬더','Kung Fu Panda','애니메이션','여인영','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('U6FHF7A','좋은 놈, 나쁜 놈, 이상한 놈','The Good, the Bad, and the Weird','액션','김지운','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('JY0H2O0','아이언맨','Iron Man','SF','존 파브로','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('AW4IAI8','강철중','Public Enemy Returns','범죄','강우석','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VHQ4D3K','우리 생애 최고의 순간','Forever the Moment','드라마','임순례','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('47TZCJO','원티드','Wanted','액션','티무르','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VC2FLAF','핸콕','Hancock','액션','피터 버그','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$sql  = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('38ABE4Q','테이큰','Taken','스릴러','피에르 모렐','2008')";
			$result['success']	= mysqli_multi_query($connect, $sql);
			
			$result['msg']		= "Database initialize.";
		
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	//신규 Movew 등록
	function CreateMovie() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$genId = generateRandomString();
			
			$title_ko = $_POST['title_ko'];
			$title_en = $_POST['title_en'];
			$genre = $_POST['genre'];
			$director = $_POST['director'];
			$release_year = $_POST['release_year'];
			
			$sql = "INSERT INTO MOVIES (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('$genId','$title_ko','$title_en','$genre','$director','$release_year')";
			
			error_log($sql);
			
			$result['success'] = mysqli_query($connect, $sql);
			$result['id'] = $genId;
			$result['title_ko'] = $title_ko;
			$result['title_en'] = $title_en;
			$result['genre'] = $genre;
			$result['director'] = $director;
			$result['release_year'] = $release_year;
			$result['msg']     = "Movie created.";
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	//선택한 Movie 삭제
	function DeleteMovie() {
		
		try {
			
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$result['success'] = mysqli_query($connect, "delete from MOVIES where id = '{$_POST['movieId']}'");
			$result['msg']     = "The selected movie has been deleted.";
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

// Movie 전체 데이터 가져오기 (Redis 캐싱 추가)
function GetListMovies()
{
    global $redis;

    try {
        session_start();
        $connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

        // Redis에서 캐시 확인
        $cacheKey = 'GetListMoviesResult';
        $cachedResult = $redis->get($cacheKey);

        if ($cachedResult) {
            $result = json_decode($cachedResult, true);
        } else {
            $query = mysqli_query($connect, "select * from MOVIES order by TITLE_KO");

            $Movies = array();
            while ($ls = mysqli_fetch_array($query)) {
                array_push($Movies, [
                    'ID' => $ls['ID'],
                    'TITLE_KO' => $ls['TITLE_KO'],
                    'TITLE_EN' => $ls['TITLE_EN'],
                    'GENRE' => $ls['GENRE'],
                    'DIRECTOR' => $ls['DIRECTOR'],
                    'RELEASE_YEAR' => $ls['RELEASE_YEAR']
                ]);
            }
            $result['data'] = $Movies;
            $result['success'] = true;

            // Redis에 결과 저장 (캐싱)
            $redis->set($cacheKey, json_encode($result));
        }

        mysqli_close($connect);
    } catch (Exception $e) {
        $result['success'] = false;
        $result['msg'] = $e->getMessage();
    } finally {
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// 화장품 전체 데이터 가져오기 (Redis 캐싱 추가)
function GetListCosmetics()
{
    global $redis;

    try {
        session_start();
        $configVars = parse_ini_file(php_ini_loaded_file(), TRUE);
        $connect = mysqli_connect($configVars['Database']['mysql.host'], $configVars['Database']['mysql.username'], $configVars['Database']['mysql.passwd'], $configVars['Database']['mysql.dbname'], $configVars['Database']['mysql.port']) or die("DB connection Failed.");

        // Redis에서 캐시 확인
        $cacheKey = 'GetListCosmeticsResult';
        $cachedResult = $redis->get($cacheKey);

        if ($cachedResult) {
            $result = json_decode($cachedResult, true);
        } else {
            $query = mysqli_query($connect, "select * from COSMETIC");

            $Cosmetics = array();
            while ($ls = mysqli_fetch_array($query)) {
                array_push($Cosmetics, [
                    'ID' => $ls['ID'],
                    'TITLE' => $ls['TITLE'],
                    'INVENTORY' => $ls['INVENTORY']
                ]);
            }
            $result['data'] = $Cosmetics;
            $result['success'] = true;

            // Redis에 결과 저장 (캐싱)
            $redis->set($cacheKey, json_encode($result));
        }

        mysqli_close($connect);
    } catch (Exception $e) {
        $result['success'] = false;
        $result['msg'] = $e->getMessage();
    } finally {
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

	
	//화장품 주문하기
	function OrderCosmetics() {
		
		try {
			session_start();
			$configVars = parse_ini_file(php_ini_loaded_file(), TRUE);
			$connect = mysqli_connect($configVars['Database']['mysql.host'], $configVars['Database']['mysql.username'], $configVars['Database']['mysql.passwd'], $configVars['Database']['mysql.dbname'], $configVars['Database']['mysql.port']) or die("DB connection Failed.");
			
			$cosmeticId = null;
			$orderVolume = null;

			$cosmeticId = $_POST['cosmeticId'];
			$orderVolume = $_POST['orderVolume'];
			
			$sql = "UPDATE COSMETIC SET INVENTORY = (INVENTORY-'$orderVolume') WHERE ID = '$cosmeticId'";
			
			$result['success'] = mysqli_query($connect, $sql);
			
			
			$query = mysqli_query($connect, "SELECT INVENTORY FROM COSMETIC WHERE ID = '$cosmeticId'");
			
			if($ls = mysqli_fetch_array($query)){
				$result['inventory']	= $ls['INVENTORY'];
			}
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
			
	}
	
	
	//화장품 수량 리셋
	// function ResetCosmeticsInventory() {
		
	//	try {
	//		session_start();
	//		$configVars = parse_ini_file(php_ini_loaded_file(), TRUE);
	//		$connect = mysqli_connect($configVars['Database']['mysql.host'], $configVars['Database']['mysql.username'], $configVars['Database']['mysql.passwd'], $configVars['Database']['mysql.dbname'], $configVars['Database']['mysql.port']) or die("DB connection Failed.");
	//		
	//		$sql = "UPDATE COSMETIC SET INVENTORY = 999 WHERE INVENTORY < 2";
	//		
	//		$result['success'] = mysqli_query($connect, $sql);
	//		
	//		mysqli_close($connect);

	//	} catch(exception $e) {
	//	
	//		$result['success']	= false;
	//		$result['msg']		= $e->getMessage();

	//	} finally {
	//		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	//		
	//	}
			
	//}
	
		
	
	//DB연결 정보 가져오기
	function getDBConnection() {
		
		session_start();
		
		return mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
					
	}
	
	
	//DB연결 정보 Session 저장
	function SaveDBTicket() {
		
		session_start();
			
		//DB 연결 테스트
		$_SESSION['db_addr'] = 		$_POST['db_addr'];
		$_SESSION['db_userId'] = 	$_POST['db_userId']; 
		$_SESSION['db_userPw'] = 	$_POST['db_userPw'];
		$_SESSION['db_name'] =		$_POST['db_name'];
		$_SESSION['db_port'] =		$_POST['db_port'];
		
		$result['success']	= true;
		
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
	}
	
	//DB연결 테스트
	function DBConnection() {

		//DB 연결 테스트
		$db_addr = 		$_POST['db_addr'];
		$db_userId = 	$_POST['db_userId']; 
		$db_userPw = 	$_POST['db_userPw'];
		$db_name =		$_POST['db_name'];
		$db_port =		$_POST['db_port'];

		try {

			$connect = mysqli_connect($db_addr, $db_userId, $db_userPw, $db_name, $db_port) or die("DB connection Failed.");
			
			// Check connection
			if (mysqli_connect_error()){
			   throw new Exception();
			}else{
				$result['success']	= true;
				$result['msg']		= "DB connection successful.";
				mysqli_close($connect);
			}
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
	}
	
	//랜덤 ID 만들기
	function generateRandomString($length = 7) {
		
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[mt_rand(0, $charactersLength - 1)];
		}
		
		return $randomString;
	}
	
	

?>
```


[CentOS 7.8.2003 Download Link](https://ftp.iij.ad.jp/pub/linux/centos-vault/7.8.2003/isos/x86_64/CentOS-7-x86_64-DVD-2003.iso)

### 3. Install CentOS 7.8 

- In Workstation Pro menu, [Edit] > [Preference]:    Select Default Hardware compatibility : *** Workstation 16.2x ***
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d4c977e8-95e6-4fad-b094-dfd1c963d55c)

- After Completing CentOS installation,
  log in as root account,

 ```
sudo SYSTEMCTL set-default multiuser.target ## CLI 모드로 부팅
shutdown now
```

### 4. Clone VM Image for Wen/App/DB VM
- In Workstation Pro left Library pane, select Vm Image just created and right mouse click
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/450c23a0-8c25-454e-9519-2e3e34e3e6a8)

- Clone 3 VMs and rename webvm, appvm dbvm
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0812f214-a99c-4ab0-bdda-916f839213a1)
---






