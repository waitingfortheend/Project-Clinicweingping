

<?php


$sql =("UPDATE user SET user_name='$_POST[user]',password='$_POST[pass]',type_id='$_POST[type]' WHERE user_name = '$_POST[user]'");
$sql_emp =("UPDATE employee SET emp_name='$_POST[name]',emp_surname='$_POST[surname]',emp_address='$_POST[address]',emp_telephone='$_POST[tel]',user_name='$_POST[user]' WHERE user_name = '$_POST[user]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
 mysqli_query($conn,$sql_emp)or die(mysql_error());
   echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=user&action=user_manage&active=active1'</script>";


}else{
   echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
   echo "<script>window.location='index.php'</script>";
}









 ?>
