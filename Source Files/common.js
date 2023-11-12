/**************************
파일 만든이 : enixone
파일 제작일 : 2023-10-06 오전 11:43:29
파일 최종수정일 :
***************************/



function evtDeleteFile(fileName, obj){
	
	$.ajax({
        url: "./fileAPI.php",
        type: "POST",
        data: {
            cmd: "DeleteFile",
			fileName: fileName,
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			if(result.success) {
				var tr = $(obj).parent().parent();
				tr.remove();
				alert("File deleted.");
			}
			
		}
    });
}	

function evtCopyLink(fileName) {
  
  var filePath = window.location.origin + "/cloud/uploads/"+fileName;
  
  const textArea = document.createElement("textarea");
  textArea.value = filePath;
  document.body.appendChild(textArea);
  
  textArea.focus();
  textArea.select();
  try {
    document.execCommand('copy');
  } catch (err) {
    console.error('Unable to copy to clipboard', err);
  }
  document.body.removeChild(textArea);
  alert("Copied to clipboard.");
}





function evtGetFileList(){
	
	$.ajax({
        url: "./fileAPI.php",
        type: "POST",
        data: {
            cmd: "GetFileList",
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			let dataRow = $('<tr></tr>');
			
			for(i=0;i<result.data.length;i++){
				
				let dataRow = $('<tr></tr>');
				
				dataRow.append('<td class="left"><a href="./uploads/'+result.data[i].filenNme+'" taget="_new">'+result.data[i].filenNme+'</a>&nbsp;</td>');
				dataRow.append('<td class="center">'+result.data[i].fileExt+'</td>');
				dataRow.append('<td class="center">'+result.data[i].mimeType+'</td>');
				dataRow.append('<td class="center">'+result.data[i].fileSize+'</td>');
				dataRow.append('<td class="center">'+result.data[i].updateDate+'</td>');
				dataRow.append('<td class="center"><img src="./icon_share.png" onclick="evtCopyLink(\''+result.data[i].filenNme+'\');" style="cursor:pointer;"></td>');
				dataRow.append('<td class="center"><img src="./icon_del.png" onclick="evtDeleteFile(\''+result.data[i].filenNme+'\', this);" style="cursor:pointer;"></td>');
				
				$("#mytbodyFile").append(dataRow);
			
			}
			
		}
		
    });
}	



function evtInitDatabase(){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "InitDatabase",
        },
		dataType: "json",
		async: false,
		success: function(result) {
			alert(result.msg);
			location.reload();
			
		}
    });
}	

function evtDropDatabaseTable(){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "DropDatabaseTable",
        },
		dataType: "json",
		async: false,
		success: function(result) {
			alert(result.msg);
			location.reload();
		}
    });
}	


function evtCreateMovie(){

	if($('#title_ko').val() == ""){
		return alert("Korean title is missing");	
	}
	
	if($('#title_en').val() == ""){
		return alert("English title is missing");	
	}
	
	if($('#director').val() == ""){
		return alert("Director is missing");	
	}
	
	if($('#release_year').val() == ""){
		return alert("Release year is missing");	
	}
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "CreateMovie",
            title_ko: $('#title_ko').val(),
            title_en: $('#title_en').val(),
            genre: $('#genre').val(),
            director: $('#director').val(),
            release_year: $('#release_year').val(),
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			if(result.success) {
				
				let dataRow = $('<tr style="background:#DAF0FF"></tr>');
					dataRow.append('<td class="center">'+result.id+'</td>');
					dataRow.append('<td>'+result.title_ko+'</td>');
					dataRow.append('<td>'+result.title_en+'</td>');
					dataRow.append('<td class="center">'+result.genre+'</td>');
					dataRow.append('<td class="center">'+result.director+'</td>');
					dataRow.append('<td class="center">'+result.release_year+'</td>');
					dataRow.append('<td class="center"><img src="./icon_del.png" onclick="evtDeleteMovie(\''+result.id+'\');" style="cursor:pointer;"></td>');
				$("#mytbody").append(dataRow);
			
			alert("A new movie has been registered.");

			}
		}
    });
}		


function evtDeleteMovie(mId){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "DeleteMovie",
            movieId : mId,
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			if(result.success) {
				alert(result.msg);
				$("td:contains('"+mId+"')").parent().remove();
			}
		}
    });
	
}


function evtDBConnection(){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "DBConnection",
			db_addr: $('#db_addr').val(),
            db_userId: $('#db_userId').val(),
            db_userPw: $('#db_userPw').val(),
            db_name: $('#db_name').val(),
            db_port: $('#db_port').val(),
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			if(result.success) {
				if (confirm(result.msg + "\nDo you want to invoke the DB Test page?")) {
					fnDatabaseOpen();
				}
			}else{
				alert("DB connection Failed.\n"+result.msg);
			}
			
		}
    });
}		


function fnGetListMovies(){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "GetListMovies",
        },
		dataType: "json",
		async: false,
		success: function(result) {
			
			let dataRow = $('<tr></tr>');
			
			for(i=0;i<result.data.length;i++){
				
				let dataRow = $('<tr></tr>');
				
				dataRow.append('<td class="center">'+result.data[i].ID+'</td>');
				dataRow.append('<td>'+result.data[i].TITLE_KO+'</td>');
				dataRow.append('<td>'+result.data[i].TITLE_EN+'</td>');
				dataRow.append('<td class="center">'+result.data[i].GENRE+'</td>');
				dataRow.append('<td class="center">'+result.data[i].DIRECTOR+'</td>');
				dataRow.append('<td class="center">'+result.data[i].RELEASE_YEAR+'</td>');
				dataRow.append('<td class="center"><img src="./icon_del.png" onclick="evtDeleteMovie(\''+result.data[i].ID+'\');" style="cursor:pointer;"></td>');
				
				$("#mytbody").append(dataRow);
			
			}
			
			
			
		}
    });
}	

function fnDatabaseOpen(){
	
	$.ajax({
        url: "./databaseMySQL.php",
        type: "POST",
        data: {
            cmd: "SaveDBTicket",
            db_addr: $('#db_addr').val(),
            db_userId: $('#db_userId').val(),
            db_userPw: $('#db_userPw').val(),
            db_name: $('#db_name').val(),
            db_port: $('#db_port').val(),
        },
		dataType: "json",
		async: false,
		success: function(result) {
			if(result.success) {
				var ret = window.open("./dbTestPage.php", "Database Test Page", "location=no,toolbar=no,resizable=no,top=100,left=600,width=1024px,height=768px,,scrollbars=yes");
			}
		}
    });
}		
		
function evtShowPHPInfo(){
	
	alert("php version");
	
}


function evtUpload(){
    	
    var formData = new FormData(document.uploadForm);
	
	$.ajax({
        url : './upload.php',
        type : 'POST',
        data : formData,
		contentType : false,
        processData : false,
		dataType: "json",
		success: function(result) {
			
			if(result.success) {
				let dataRow = $('<tr style="background:#DAF0FF"></tr>');
					dataRow.append('<td class="left"><a href="./uploads/'+result.filenNme+'" taget="_new">'+result.filenNme+'</a>&nbsp;</td>');
					dataRow.append('<td class="center">'+result.fileExt+'</td>');
					dataRow.append('<td class="center">'+result.mimeType+'</td>');
					dataRow.append('<td class="center">'+result.fileSize+'</td>');
					dataRow.append('<td class="center">'+result.updateDate+'</td>');
					dataRow.append('<td class="center"><img src="./icon_share.png" onclick="evtCopyLink(\''+result.filenNme+'\');" style="cursor:pointer;"></td>');
					dataRow.append('<td class="center"><img src="./icon_del.png" onclick="evtDeleteFile(\''+result.filenNme+'\');" style="cursor:pointer;"></td>');
				$("#mytbodyFile").append(dataRow);
			
				alert("The file has been uploaded. : " + result.filenNme);
			}
			
		}
    });
}

function evtShowPHPInfo(){
	var ret = window.open("./phpInfo.php", "PHP Information", "location=no,toolbar=no,resizable=no,top=100,left=600,width=1024px,height=768px,,scrollbars=yes");
}


function evtChageImage(param){
	
	if(param == "GIF"){
		
		document.getElementById("myImage").src = "./sample/gif.gif";
		alert("Sample GIF Image source \n" + document.getElementById("myImage").src);
	
	}else if(param == "PNG"){
		
		document.getElementById("myImage").src = "./sample/png.png";
		alert("Sample GIF Image source \n" + document.getElementById("myImage").src);
	
	}else if(param == "JPG"){
		
		document.getElementById("myImage").src = "./sample/jpg.jpg";
		alert("Sample GIF Image source \n" + document.getElementById("myImage").src);
	
	}else if(param == undefined){
		
		if(document.multimediaForm.myImageSrc.value == ""){
			return alert("Image source empty.");
		}
		
		document.getElementById("myImage").src = document.multimediaForm.myImageSrc.value;
		
	}
	
		
}

function evtChageVideo(param){
	
	if(param == "Anime"){
		document.getElementById("myVideo").src = "./sample/Anime.mp4";
		alert("Sample Video source \n" + document.getElementById("myVideo").src);
		
	}else if(param == "Subscribe"){
		document.getElementById("myVideo").src = "./sample/Subscribe.mp4";
		alert("Sample Video source \n" + document.getElementById("myVideo").src);
		
	}else if(param == "Nature"){
		document.getElementById("myVideo").src = "./sample/Nature.mp4";
		alert("Sample Video source \n" + document.getElementById("myVideo").src);
		
	}else if(param == undefined){
		
		if(document.multimediaForm.myVideoSrc.value == ""){
			return alert("Video source empty.");
		}
		
		document.getElementById("myVideo").src = document.multimediaForm.myVideoSrc.value;
	}
	
	
	
}







