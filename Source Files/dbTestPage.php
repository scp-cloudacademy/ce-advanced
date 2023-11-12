<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Detail Information</title>
<link rel="stylesheet" type="text/css" href="./common.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<script type="text/javascript" src="./common.js"></script>
<script type="text/javascript" src="./jquery.min.js"></script>
</head>


<body>
<div class="popZone" style="background-color:#3E6E93">■ Database Test Page-MySQL</div>
<div class="wrap">
<div class="listTitle"><font style="box-shadow:inset 0-15px #9AD6FF;font-size:20px;">> Movie List</font></div>
<br>
<button onclick="evtInitDatabase();" style="">&nbsp;&nbsp;Initialize Movie Table&nbsp;&nbsp;</button> &nbsp; 
<button onclick="evtDropDatabaseTable();" style="">&nbsp;&nbsp;Drop & Clean Movie Table&nbsp;&nbsp;</button>
<br><br>
<table class="table" style="width:100%;">
  <colgroup>
    <col style="width:100px;">
	<col style="width:200px;">
	<col style="width:200px;">
    <col style="width:100px;">
	<col style="width:120px;">
	<col style="width:100px;">
	<col style="width:50px;">
  </colgroup>
  <thead>
	  <tr>
	    <th>Movie ID</th>
		<th>제목</th>
		<th>Title</th>
	    <th>Genre</th>
		<th>Director</th>
		<th>Release Year</th>
		<th>Action</th>
	  </tr>
	</thead>
	<tbody id="mytbody">
	  <tr>
		<td class="_bold" style="color:#FF0000">New Movie</td>
		<td><input type="text" name="title_ko" id="title_ko" style="width:200px;" placeholder="Enter a Korean title" value="한국영화 장길산"></td>
		<td><input type="text" name="title_en" id="title_en" style="width:200px;" placeholder="Enter a title" value="Korean Movie"></td>
		<td><input type="text" name="genre" id="genre" style="width:90px;text-align:center;" placeholder="Enter genre" value="르와르"></td>
		<td><input type="text" name="director" id="director" style="width:120px;text-align:center;" placeholder="Enter director" value="최원길"></td>
		<td><input type="text" name="release_year" id="release_year" style="width:90px;text-align:center;" placeholder="Enter release year" value="2019"></td>
		<td class="center"><img src="./icon_new.png" onclick="evtCreateMovie();" style="cursor:pointer;"></td>
	  </tr>
	  
	</tbody>
</table>
</body>
</html>


<script>
fnGetListMovies();
</script>
