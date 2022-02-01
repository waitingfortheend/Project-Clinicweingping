<?php


$sym_id = $_GET['sym_id'];


mysqli_query($conn,"DELETE FROM symptoms WHERE sym_id = '$sym_id'") or die(mysql_error());

echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";


?>



