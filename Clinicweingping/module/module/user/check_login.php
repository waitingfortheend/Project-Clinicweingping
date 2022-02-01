<?php
session_start();

include("../../include/connect_db.php");


$strUsername = trim($_POST["tUsername"]);
$strPassword = trim($_POST["tPassword"]);

//*** Check Username ***//
if(trim($strUsername) == "")
{
    echo "<font color=red>**</font> กรุณากรอก Username <font color=red>**</font>";
    exit();
}

//*** Check Password ***//
if(trim($strPassword) == "")
{
    echo "<font color=red>**</font> กรุณากรอก Password <font color=red>**</font>";
    exit();
}




//*** Check Username & Password ***//

$strSQL = "SELECT * FROM user WHERE user_name = '$strUsername' and password = '$strPassword' ";
$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
// $objResult = mysql_fetch_array($objQuery);

$rs = mysqli_query($conn,$strSQL) or die(mysql_error());

 list($db_user,$db_pass,$login_type)= mysqli_fetch_array($rs , MYSQLI_NUM);

if(mysqli_num_rows($rs) > 0) {
    echo "Y";


    if(strtolower($_POST['tUsername']) == $db_user and strtolower($_POST['tPassword'])==$db_pass){
        $_SESSION['valid_user']=$db_user;
        $_SESSION['login_type']=$login_type;


    }


}
else
{
    echo "<font color=red>**</font> Username หรือ Password ผิด <font color=red>**</font>";
}


?>
