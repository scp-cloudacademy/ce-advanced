<?php

// 설정
$uploads_dir = './uploads';
$allowed_ext = array('jpg','jpeg','png','gif');
 
// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
//$ext = array_pop(explode('.', $name));

$ext = explode('.',$name); 
$ext = strtolower(array_pop($ext));






// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}
 
// 확장자 확인
/*
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}
*/



$newName = GetUniqFileName($name, "$uploads_dir/"); // 같은 화일 이름이 있는지 검사


$filePath = "$uploads_dir/$newName";

// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], $filePath);


$result['success']	= true;
$result['filenNme']	= $newName;
$result['updateDate']= date ("Y-m-d H:i", filemtime($filePath));
$result['fileExt']	= pathinfo($filePath, PATHINFO_EXTENSION);
$result['mimeType']	= mime_content_type($filePath);
$result['fileSize']	= number_format(filesize($filePath)/1024);

echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);


function GetUniqFileName($FN, $PN)
{
  $FileExt = substr(strrchr($FN, "."), 1); // 확장자 추출
  $FileName = substr($FN, 0, strlen($FN) - strlen($FileExt) - 1); // 화일명 추출
 
  $FileCnt = 0;
  $ret = "$FileName.$FileExt";
  
  while(file_exists($PN.$ret)) // 화일명이 중복되지 않을때 까지 반복
  {
    $FileCnt++;
    $ret = $FileName."_".$FileCnt.".".$FileExt; // 화일명뒤에 (_1 ~ n)의 값을 붙여서....
  }
 
  return($ret); // 중복되지 않는 화일명 리턴
}



?>