<?php


   mysqli_query($conn,"DELETE FROM type_drug WHERE type_d_id = '$_GET[type_d_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลประยาเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=drug&action=drug_type_manage&active=active8'</script>";


a
 ?>
