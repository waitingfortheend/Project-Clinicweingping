

<?php

   mysqli_query($conn,"DELETE FROM user WHERE user_name = '$_GET[user_name]'") or die(mysql_error());
   mysqli_query($conn,"DELETE FROM employee WHERE user_name = '$_GET[user_name]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลผู้ใช้เรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=user&action=user_manage&active=active1'</script>";



 ?>
