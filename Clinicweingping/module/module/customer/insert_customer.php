<?php


$cus_id = $_POST['cus_id'];


$sql_cus = "INSERT INTO customer(cus_id,cus_name,cus_surname,cus_address,cus_telephone) values('$cus_id','$_POST[cus_name]','$_POST[cus_surname]','$_POST[cus_address]','$_POST[cus_telephone]')";



if(mysqli_query($conn,$sql_cus)or die(mysql_error())){

   echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=customer&action=customer_manage&active=active3'</script>";

}else{
   echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
      echo "<script>window.location='index.php&module=user&action=insert_form&active=active4'</script>";
}












 ?>
