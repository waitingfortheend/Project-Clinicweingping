<?php


   mysqli_query($conn,"DELETE FROM service WHERE ser_id = '$_GET[ser_id]'") or die(mysql_error());
   mysqli_query($conn,"DELETE FROM service_detail WHERE ser_id = '$_GET[ser_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลการบริการเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=service&action=service_manage&active=active11'</script>";



 ?>
