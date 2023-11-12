<?php
	header('Content-Type: text/html; charset=UTF-8');
	

	//명령어 구분
	$cmd 			= $_POST['cmd'];
		
	if($cmd == "DBConnection"){			//DB연결 테스트
		DBConnection();
	}elseif($cmd == "SaveDBTicket"){		//DB연결 정보 Session 저장
		SaveDBTicket();
	}elseif($cmd == "GetListMovies"){		//Movie 전체 데이터 가져오기
		GetListMovies();
	}elseif($cmd == "DeleteMovie"){			//선택한 Movie 삭제
		DeleteMovie();
	}elseif($cmd == "CreateMovie"){			//신규 Movie 등록
		CreateMovie();
	}elseif($cmd == "InitDatabase"){		//데이터베이스 테이블 초기화
		InitDatabase();
	}elseif($cmd == "DropDatabaseTable"){	//테이블 Drop
		DropDatabaseTable();
	}
	
	
	//Table Drop
	function DropDatabaseTable() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "DROP TABLE movies";
			
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
	
	
	//데이터베이스 테이블 초기화
	function InitDatabase() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "CREATE TABLE temp_test.`movies` ("
				  ."`ID` 	  varchar(7) NOT NULL,"
				  ."`TITLE_KO` varchar(256) NOT NULL,"
				  ."`TITLE_EN` varchar(256) NOT NULL,"
				  ."`GENRE` varchar(256) DEFAULT NULL,"
				  ."`DIRECTOR` varchar(128) DEFAULT NULL,"
				  ."`RELEASE_YEAR` varchar(4) DEFAULT NULL,"
				  ."PRIMARY KEY (`ID`)"
				.") ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
			$pResult = mysqli_query($connect, $sql);
			
			$sql  = iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('DYXZBUH','추격자','The Chaser','범죄','나홍진','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('FNZS7SB','쿵푸팬더','Kung Fu Panda','애니메이션','여인영','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('U6FHF7A','좋은 놈, 나쁜 놈, 이상한 놈','The Good, the Bad, and the Weird','액션','김지운','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('JY0H2O0','아이언맨','Iron Man','SF','존 파브로','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('AW4IAI8','강철중','Public Enemy Returns','범죄','강우석','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VHQ4D3K','우리 생애 최고의 순간','Forever the Moment','드라마','임순례','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('47TZCJO','원티드','Wanted','액션','티무르','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VC2FLAF','핸콕','Hancock','액션','피터 버그','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('38ABE4Q','테이큰','Taken','스릴러','피에르 모렐','2008');");
			
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
			
			$sql = "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('$genId','$title_ko','$title_en','$genre','$director','$release_year')";
			
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
			
			$result['success'] = mysqli_query($connect, "delete from movies where id = '{$_POST['movieId']}'");
			$result['msg']     = "The selected movie has been deleted.";
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	//Movie 전체 데이터 가져오기
	function GetListMovies() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$query = mysqli_query($connect, "select * from movies order by TITLE_KO");
			
			$Movies = array();
			while($ls = mysqli_fetch_array($query)){
				array_push($Movies,[
					'ID' => $ls['ID'],
					'TITLE_KO' => $ls['TITLE_KO'],
					'TITLE_EN' => $ls['TITLE_EN'],
					'GENRE' => $ls['GENRE'],
					'DIRECTOR' => $ls['DIRECTOR'],
					'RELEASE_YEAR' => $ls['RELEASE_YEAR']
				]);  
			}
			$result['data']	= $Movies;
			$result['success']	= true;
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
			
	}
	
	
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
