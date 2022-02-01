<?php


mysqli_query($conn,"DELETE FROM treatment_drug WHERE treat_drug_id = '$_GET[treat_drug_id]'") or die(mysql_error());

echo "<script>alert('ลบข้อมูลการซื้อเรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=dispensation&action=dispensation_manage&active=active15'</script>";



?>
