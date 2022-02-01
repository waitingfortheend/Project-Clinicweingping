<?php


$diseasetypeid = $_GET['diseasetypeid'];

mysqli_query($conn,"DELETE FROM diseasetype WHERE diseasetypeid = '$diseasetypeid'") or die(mysql_error());
mysqli_query($conn,"DELETE FROM symptoms WHERE diseasetypeid = '$diseasetypeid'") or die(mysql_error());



echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";



?>
