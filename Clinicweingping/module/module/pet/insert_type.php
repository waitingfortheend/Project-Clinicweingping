<?php


$sql_tdrug = "INSERT INTO pet_type(pet_type_name) values('$_POST[type_name]')";


if (mysqli_query($conn,$sql_tdrug) or die(mysql_error())) {

    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=pet&action=pet_type_manage&active=active6'</script>";

} else {
    echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
    echo "<script>window.location='index.php?module=pet&action=pet_type_manage&active=active6'</script>";
}


?>
