<?php




$sql =("UPDATE type_drug SET type_d_name='$_POST[type_name]' WHERE type_d_id = '$_POST[type_d_id]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
   echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=drug&action=drug_type_manage&active=active8'</script>";


}else{
   echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
   echo "<script>window.location='index.php'</script>";
}










 ?>
