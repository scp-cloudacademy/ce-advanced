<?php  

	//명령어 구분
	$cmd 			= $_POST['cmd'];
		
	if($cmd == "GetFileList"){			//파일 목록 가져오기
		GetFileList();
	}elseif($cmd == "DeleteFile"){		//선택한 파일 삭제
		DeleteFile();
	}

	//파일 삭제
	function DeleteFile() {
		
		$uploads_dir = './uploads';
		$fileName = $_POST['fileName'];
		$filePath = "$uploads_dir/$fileName";
		
		unlink($filePath);
		$result['success']	= true;
		
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		
	}

	
	//파일 목록 가져오기
	function GetFileList() {
	
		// 폴더명 지정  
		$dir = "./uploads";  
		$filePath = "";
		  
		// 핸들 획득  
		$handle  = opendir($dir);  
		  
		$files = array();  
		$exts = array();  
		
		
		// 디렉터리에 포함된 파일을 저장한다.  
		$fileItems = array();
		while (false !== ($filename = readdir($handle))) {  
			
			if($filename == "." || $filename == ".." || $filename == "Thumbs.db"){  
				continue;  
			}  
		
			$filePath = $dir . "/" . $filename;
		
			// 파일인 경우만 목록에 추가한다.  
			if(is_file($filePath)){  
				array_push($fileItems,[
					'filenNme' => pathinfo($filePath, PATHINFO_BASENAME),
					'updateDate' => date ("Y-m-d H:i", filemtime($filePath)),
					'fileExt' => pathinfo($filePath, PATHINFO_EXTENSION),
					'mimeType' => mime_content_type($filePath),
					'fileSize' => number_format(filesize($filePath)/1024)
				]);
			}  
		}  
		$result['data']	= $fileItems;
		$result['success']	= true;
		// 핸들 해제  
		closedir($handle);  
		  
		// 정렬, 역순으로 정렬하려면 rsort 사용  
		sort($files);  
		  
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		
	}
?>  