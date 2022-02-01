<?php

$type_name =mysql_real_escape_string("$_POST[type_name]");

$sql_tdrug = "INSERT INTO type_drug(type_d_name) values('$type_name')";


if (mysqli_query($conn,$sql_tdrug) or die(mysql_error())) {

    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=drug&action=drug_type_manage&active=active8'</script>";

} else {
    echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
    echo "<script>window.location='index.php?module=drug&action=drug_type_manage&active=active8'</script>";
}


?>
