<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cloud Configuration Verify</title>
<link rel="stylesheet" type="text/css" href="./common.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<script type="text/javascript" src="./common.js"></script>
<script type="text/javascript" src="./jquery.min.js"></script>
</head>

<body style="margin-bottom:30px;">
<div class="popZone">■ Cloud Configuration Verify</div>
<div class="wrap">

<div class="listTitle"><font style="box-shadow:inset 0-15px #ffeb3b;font-size:20px;">> Server Information</font></div>

<table class="table">
  <colgroup>
    <col style="width:200px;">
    <col style="width:1080px;">
  </colgroup>
  <thead>
	  <tr>
	    <th>Div</th>
	    <th>Contents</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td class="_bold">Server Name</td>
	    <td class="_red_font"><?=$_SERVER['SERVER_NAME']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server IP</td>
	    <td class="_red_font"><?=$_SERVER['SERVER_ADDR']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Web Server</td>
	    <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">PHP Version</td>
	    <td>PHP Version <?=phpversion()?> <a href="#" onclick="evtShowPHPInfo();"><img src="./detail_16.png" align="absmiddle" width="20px"></a></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server Port</td>
	    <td><?=$_SERVER['SERVER_PORT']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server Resource Path</td>
	    <td><?=$_SERVER['DOCUMENT_ROOT']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server Page Name</td>
	    <td><?=$_SERVER['PHP_SELF']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Request URI</td>
	    <td><?=$_SERVER['REQUEST_URI']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server Encoding</td>
	    <td><?=$_SERVER['HTTP_ACCEPT_ENCODING']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Language</td>
	    <td><?=$_SERVER['HTTP_ACCEPT_LANGUAGE']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">CGI Information </td>
	    <td><?=$_SERVER['GATEWAY_INTERFACE']?></td>
	  </tr>
	  <tr>
	    <td class="_bold">Server Protocol </td>
	    <td><?=$_SERVER['SERVER_PROTOCOL']?></td>
	  </tr>
	</tbody>
</table>

<div class="listTitle"><font style="box-shadow:inset 0-15px #ffeb3b;font-size:20px;">> Client Information</font></div>

	<table class="table">
	  <colgroup>
	    <col style="width:200px;">
    <col style="width:1080px;">
	  </colgroup>
	  <thead>
		  <tr>
		    <th>Div</th>
		    <th>Contents</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
		    <td class="_bold">Client IP</td>
		    <td class="_red_font"><?=get_client_ip()?></td>
		  </tr>
		  <tr>
		    <td class="_bold">Client Agent</td>
		    <td><?=$_SERVER['HTTP_USER_AGENT']?></td>
		  </tr>
		</tbody>
	</table>

<div class="listTitle"><font style="box-shadow:inset 0-15px #ffeb3b;font-size:20px;">> Database Connection Test</font></div>

<form name="dbForm">

	<table class="table">
	  <colgroup>
	    <col style="width:200px;">
		<col style="width:1080px;">
	  </colgroup>
	  <tbody>
		  <tr>
		    <td class="_bold">Database Address</td>
		    <td><input type="text" name="db_addr" id="db_addr" placeholder="Enter server name or IP" value="127.0.0.1"> : <input type="text" name="db_port" id="db_port" placeholder="Port no" value="3306" size="4">
		   	</td>
		  </tr>
		  <tr>
		    <td class="_bold">User ID/Password</td>
		    <td><input type="text" name="db_userId" id="db_userId" placeholder="Enter user id" value="sqladmin"> / <input type="text" name="db_userPw" id="db_userPw" placeholder="Enter user password"  value="Asdf1234!@#$">
		   	</td>
		  </tr>
		  <tr>
		    <td class="_bold">Database Name</td>
		    <td><input type="text" name="db_name" id="db_name" placeholder="Enter database name" value="temp_test">&ensp;&ensp;<button onclick="evtDBConnection();" style="">&nbsp;&nbsp;Database Connection&nbsp;&nbsp;</button>
		   	</td>
		  </tr>
		</tbody>
	</table> 

</form>

<div class="listTitle"><font style="box-shadow:inset 0-15px #ffeb3b;font-size:20px;">> File Upload</font></div>

<form enctype='multipart/form-data' method='post' name='uploadForm' onsubmit="return false;">

	<table class="table">
	  <colgroup>
	    <col style="width:200px;">
		<col style="width:1080px;">
	  </colgroup>
	  <tbody>
		  <tr>
		    <td class="_bold">File Upload</td>
		    <td>
				<input type='file' name='myfile'>
				<button onclick="evtUpload();" style="">&nbsp;Upload&nbsp;</button>
		   	</td>
		  </tr>
		</tbody>
	</table>
	
	<table class="table">
		<colgroup>
			<col style="width:600px;">
			<col style="width:90px;">
			<col style="width:250px;">
			<col style="width:100px;">
			<col style="width:160px;">
			<col style="width:40px;">
			<col style="width:40px;">
		</colgroup>
		<thead>
			<tr id="kimsfeel">
				<th>Name</th>
				<th>Ext.</th>
				<th>Mime Type</th>
				<th>Size(KB)</th>
				<th>Date</th>
				<th>Link</th>
				<th>Del.</th>
			</tr>
		</thead>
		<tbody id="mytbodyFile">
		</tbody>
	</table>
</form>
<script>
evtGetFileList();
</script>

<div class="listTitle"><font style="box-shadow:inset 0-15px #ffeb3b;font-size:20px;">> Multimedia Contents</font></div>

<form name='multimediaForm' onsubmit="return false;">

	<table class="table">
	  <colgroup>
	    <col style="width:640px;">
    	<col style="width:640px;">
	  </colgroup>
	  <tbody>
		  <tr>
		    <td>▶ Image Source : <input type="text" style="width:450px" name="myImageSrc">&nbsp;<button onclick="evtChageImage();" style="">&nbsp;Run&nbsp;</button></td>
		    <td>▶ Video Source : <input type="text" style="width:450px" name="myVideoSrc">&nbsp;<button onclick="evtChageVideo();" style="">&nbsp;Run&nbsp;</button></td>
		  </tr>
		  <tr>
			<td class="_bgImage"><embed type="image/jpg" src="" style="width:100%;" bgcolor='#000000' id="myImage"></td>
			<td class="_bgVideo"><embed type="video/webm" src="" style="width:100%;height:300px;" bgcolor='#000000' id="myVideo"></td>
		  </tr>
		  <tr>
		    <td>
				<label style="cursor:pointer;"><input type="radio" name="sampleImg" onclick="evtChageImage('JPG');">&nbsp;SAMPLE-JPG&nbsp;</label>
				<label style="cursor:pointer;"><input type="radio" name="sampleImg" onclick="evtChageImage('PNG');">&nbsp;SAMPLE-PNG&nbsp;</label>
				<label style="cursor:pointer;"><input type="radio" name="sampleImg" onclick="evtChageImage('GIF');">&nbsp;SAMPLE-GIF&nbsp;</label>
			</td>
		    <td>
				<label style="cursor:pointer;"><input type="radio" name="sampleMovie" onclick="evtChageVideo('Anime');">&nbsp;SAMPLE-Anime&nbsp;</label>
				<label style="cursor:pointer;"><input type="radio" name="sampleMovie" onclick="evtChageVideo('Subscribe');">&nbsp;SAMPLE-Subscribe&nbsp;</label>
				<label style="cursor:pointer;"><input type="radio" name="sampleMovie" onclick="evtChageVideo('Nature');">&nbsp;SAMPLE-Nature&nbsp;</label>
			</td>
		  </tr>
		</tbody>
	</table>
</form>



<hr/>
<span style="text-align: center;">@feelatech</span>
</body>
</html>

<?php

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>

