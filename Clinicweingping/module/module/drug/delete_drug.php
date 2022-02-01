<?php

if(isset($_GET['d_id'])) {

    $rs = mysqli_query($conn,"SELECT d_picture FROM drug WHERE d_id='$_GET[d_id]'") or die(mysql_error());
    list($pic_name) = mysqli_fetch_array($rs);

    if (!empty($pic_name)) {//ถ้ามีไฟล์รูปภาพ
        unlink("images/$pic_name");


    }
}

   mysqli_query($conn,"DELETE FROM drug WHERE d_id = '$_GET[d_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลยาเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=drug&action=drug_manage&active=active7'</script>";



 ?>
