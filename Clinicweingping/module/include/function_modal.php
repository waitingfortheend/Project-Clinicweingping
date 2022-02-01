<?php
session_start();
function check_type($type){
    //ถ้าไม่ได้ล๊อคอิน หรือ ล๊อกอินแล้วแต่ login type ไม่ตามที่กำหนด
    if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="$type" ){
        session_destroy();
        echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
        echo "<script>window.location='../index.php'</script>";
    }


}

?>