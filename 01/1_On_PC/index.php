// NOTEPAD의 "바꾸기"로 "./web" > "https://obj2.kr-west-1.samsungsdscloud.com:8443/weba/web"
// web 폴더의 경로를 ObjectStorage로 바꾸는것으로 ObjectStorage의 파일 활용 가능

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cosmetic Evolution</title>
<link rel="stylesheet" type="text/css" href="./web/css/common.css">
<link rel="shortcut icon" type="image/x-icon" href="./web/images/favicon.ico" />
<script type="text/javascript" src="./web/javascript/common.js"></script>
<script type="text/javascript" src="./web/javascript/jquery.min.js"></script>
</head>

<body align="center" bgcolor="#FFFFFF">
<div class="topZone"><img src='./web'></div>
<div class="topWrap">

<table style="margin-left: auto; margin-right: auto;">
  <colgroup>
    <col style="width:352px;">
    <col style="width:630px;">
  </colgroup>
  <tbody>
          <tr>
            <td>
                <embed type="image/jpg" src='./web/media/contents/cosmetic1.jpg' style="width:100%" bgcolor='#000000' id="myImage">
                </td>
            <td>
                                <video controls loop autoplay muted controls width="100%">
                                  <source src="./web/media/contents/cosmetic.mp4" id="cosmetic_video" type="video/webm" />
                                </video>
                        </td>
                      </tr>
                    </table>
                    
                    <table class="table0" style="margin-left: auto; margin-right: auto;" border=0   >
                      <colgroup>
                        <col style="width:500px;">
                        <col style="width:180px;">
                        <col style="width:180px;">
                        <col style="width:120px;">
                      </colgroup>
                      <thead>
                                    <tr id="kimsfeel">
                                            <th>Product</th>
                                            <th>Available</th>
                                            <th>Quantity(max 9)</th>
                                            <th>Order</th>
                                    </tr>
                            </thead>
                            <tbody id="mytbody">
                    </table>
                    
                    
                    <form enctype='multipart/form-data' method='post' name='uploadForm' onsubmit="return false;">
                    <table class="table1" style="margin-left: auto; margin-right: auto;" border=1>
                              <colgroup>
                                <col style="width:300px;">
                                <col style="width:380px;">
                                <col style="width:50px;">
                                <col style="width:240px;">
                              </colgroup>
                              <tbody>
                                <tr>
                                  <td class="center" style="font-size:16px;font-weight:600;">Membership Registration?</td>
                                  <td><input type='file' name='myfile'></td>
                                  <td><button onclick="evtUploadFile();" style="">&nbsp;Upload&nbsp;</button></td>
                                  <td class="center"><a href="" style="font-size:16px;"><a href="./web/media/contents/Registration Form.pdf" download="Registration Form">Download Registration Form</a></td>
                                </tr>
                      </table>
              </form>
              </div>
              
              <div class="bottomZone">
                      <table class="table1" style="margin-left: auto; margin-right: auto;" border=0>
                        <colgroup>
                          <col style="width:336px;">
                          <col style="width:640px;">
                        </colgroup>
                        <tbody>
                                <tr>
                                  <td class="left" style="padding:20px"><a href="" onclick="evtGoAdminTool();">Administrator Page</a><br><a href="" onclick="evtShowPHPInfo();">PHP Information</a><br><a href="" onclick="evtResetCosmeticsInventory();">Replenish inventory</a>
                                      </td>
                                  <td class="right">Server IP : <?=$_SERVER['SERVER_ADDR']?> / Client IP : <?=get_client_ip()?>
                                              </td>
                                </tr>
                      </table>
              </div>
              </body>
              </html>
              <script>

function evtGoAdminTool(){
                var ret = window.open("./was/admin.php", "adminTool", "location=no,toolbar=no,resizable=no,top=100,left=600,width=1024px,height=768px,,scrollbars=yes");
        }

        fnGetListCosmetics();

        /**
         * <96>¹®ȏ±ފ     */
        function evtOrder(obj){
                var orderVolume = $('select[name='+obj+']').val();
                if(orderVolume < 1){
                        alert("Order quantity must be at least 1.");
                        return;
                }
                $.ajax({
                url: "./was/apiDatabase.php",
                type: "POST",
                data: {
                    cmd: "OrderCosmetics",
                    cosmeticId: obj,
                    orderVolume: orderVolume,
                },
                        dataType: "json",
                        async: false,
                        success: function(result) {
                                $('td[name='+obj+']').text(result.inventory);
                                console.log(result.inventory);
                                alert("Order successful  : " + orderVolume);
                        }
                      });
        }


        /**
         * ȭeǰ g°롃߰¡
         */
        function evtResetCosmeticsInventory(){

                if(!confirm("Do you want to replenish the inventory? (Target : less than one)")){
                        return;
                }

                $.ajax({
                url: "./was/apiDatabase.php",
                type: "POST",
                data: {
                    cmd: "ResetCosmeticsInventory",
                },
                        dataType: "json",
                        async: false,
                        success: function(result) {
                                console.log(result);
                                alert("Replenish successful");
                                location.reload(true);
                        },
                        error : function(result){
                                console.log(result);
                        }

                });
              }


</script>


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
