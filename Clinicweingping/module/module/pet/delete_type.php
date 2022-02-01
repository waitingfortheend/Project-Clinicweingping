<?php


mysqli_query($conn,"DELETE FROM pet_type WHERE pet_type = '$_GET[type_d_id]'") or die(mysql_error());

echo "<script>alert('ลบข้อมูลประสัตว์เรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=pet&action=pet_type_manage&active=active6'</script>";


a
?>
