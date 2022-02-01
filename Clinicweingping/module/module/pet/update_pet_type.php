<?php




$sql =("UPDATE pet_type SET pet_type_name='$_POST[type_name]' WHERE pet_type = '$_POST[type_d_id]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=pet&action=pet_type_manage&active=active6'</script>";


}else{
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
    echo "<script>window.location='index.php'</script>";
}










?>
