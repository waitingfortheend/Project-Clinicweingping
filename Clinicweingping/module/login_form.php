<?php

include ("include/connect_db.php");



?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ClinicWeingPing | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<script language="JavaScript">
    var HttPRequest = false;

    function doCallAjax() {
        HttPRequest = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            HttPRequest = new XMLHttpRequest();
            if (HttPRequest.overrideMimeType) {
                HttPRequest.overrideMimeType('text/html');
            }
        } else if (window.ActiveXObject) { // IE
            try {
                HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                }
            }
        }

        if (!HttPRequest) {
            alert('Cannot create XMLHTTP instance');
            return false;
        }

        var url = 'module/module/user/check_login.php';
        var pmeters = "tUsername=" + encodeURI(document.getElementById("txtUsername").value) +
            "&tPassword=" + encodeURI(document.getElementById("txtPassword").value);

        HttPRequest.open('POST', url, true);

        HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        HttPRequest.setRequestHeader("Content-length", pmeters.length);
        HttPRequest.setRequestHeader("Connection", "close");
        HttPRequest.send(pmeters);


        HttPRequest.onreadystatechange = function () {

            if (HttPRequest.readyState == 3)  // Loading Request
            {
                document.getElementById("mySpan").innerHTML = "<font color=red>Loading...</font>";
            }

            if (HttPRequest.readyState == 4) // Return Request
            {
                if (HttPRequest.responseText == 'Y') {
                    window.location = 'module/index.php?module=user&action=profile';
                }
                else {
                    document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                }
            }

        }

    }

    $("#txtPassword").on('keyup', function (e) {
    if (e.keyCode === 13) {
        // Do something
        doCallAjax();
    }
    });

    
    $("#txtUsername").on('keyup', function (e) {
    if (e.keyCode === 13) {
        // Do something
        document.getElementById("txtPassword").focus();
    }
    });



    

</script>
<body class="gray-bg">

<form name="frmMain" class="m-t" role="form">

    <div class="middle-box text-center loginscreen animated fadeInDown">

<!--        <div>-->
<!---->
<!--            <h1 class="logo-name">WP</h1>-->
<!---->
<!--        </div>-->
        <h2>ยินดีต้อนรับ</h2>
        <h3>คลินิกเวียงพิงค์รักษาสัตว์</h3>


        <div class="form-group">

            <input type="text" name="txtUsername" class="form-control" placeholder="ชื่อผู้ใช้" id="txtUsername" required >
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="รหัสผ่าน" name="txtPassword" id="txtPassword" required >
        </div>


        <div class="form-group">
        <input name="btnLogin" class="btn btn-primary block full-width m-b" type="button" id="btnLogin"
               OnClick="JavaScript:doCallAjax();" value="เข้าสู่ระบบ">
        <span id="mySpan"></span>
        </div>

    </div>

</form>
</body>
</html>



