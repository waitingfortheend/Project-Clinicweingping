<?php


   mysqli_query($conn,"DELETE FROM customer WHERE cus_id = '$_GET[cus_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลลูกค้าเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=customer&action=customer_manage&active=active3'</script>";



 ?>
