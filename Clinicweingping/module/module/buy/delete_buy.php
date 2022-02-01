<?php


   mysqli_query($conn,"DELETE FROM buy WHERE buy_id = '$_GET[buy_id]'") or die(mysql_error());
   mysqli_query($conn,"DELETE FROM buy_detail WHERE buy_id = '$_GET[buy_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลการซื้อเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=buy&action=buy_manage&active=active9'</script>";



 ?>
