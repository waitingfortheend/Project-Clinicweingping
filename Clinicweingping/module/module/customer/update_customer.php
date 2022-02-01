<?php



$sql =("UPDATE customer SET cus_name='$_POST[cus_name]',cus_surname='$_POST[cus_surname]',cus_address='$_POST[cus_address]',cus_telephone='$_POST[cus_telephone]' WHERE cus_id = '$_POST[cus_id]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
   echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=customer&action=customer_manage&active=active3'</script>";


}else{
   echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
   echo "<script>window.location='index.php'</script>";
}









 ?>
