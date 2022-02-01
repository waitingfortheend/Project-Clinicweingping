<?php


mysqli_query($conn,"DELETE FROM treatment WHERE treat_id = '$_GET[treat_id]'") or die(mysql_error());

echo "<script>alert('ลบข้อมูลการรักษาเรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=treatment&action=treatment_manage&active=active13'</script>";



?>
