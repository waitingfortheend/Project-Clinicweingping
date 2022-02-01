<?php



    if(isset($_GET['pet_id'])) {

            $rs = mysqli_query($conn,"SELECT pet_picture FROM pet WHERE pet_id='$_GET[pet_id]'") or die(mysql_error());
            list($pic_name) = mysqli_fetch_array($rs);
         
            if (!empty($pic_name)) {//ถ้ามีไฟล์รูปภาพ
                unlink("images/$pic_name");


            }
        }

    mysqli_query($conn,"DELETE FROM pet WHERE pet_id = '$_GET[pet_id]'") or die(mysql_error());

   echo "<script>alert('ลบข้อมูลสัตว์เรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=pet&action=pet_manage&active=active5'</script>";



 ?>
