<?php



$sql =("UPDATE user SET user_name='$_POST[user]',password='$_POST[pass]',type_id='$_POST[type]' WHERE user_name = '$_POST[user]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
     echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=permissions&action=permissions_manage&active=active25'</script>";


}else{
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
    echo "<script>window.location='index.php'</script>";
}









?>
