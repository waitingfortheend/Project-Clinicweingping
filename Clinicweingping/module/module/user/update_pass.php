<?php

$sql =("UPDATE user SET password='$_POST[pass2]' WHERE user_name = '$_POST[user]'");


if(mysqli_query($conn,$sql)or die(mysql_error())  ){
    echo "<script>alert('แก้ไขรหัสผ่านเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=user&action=profile'</script>";


}else{
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>