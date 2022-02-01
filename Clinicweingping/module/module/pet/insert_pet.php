<?php


$cus_id = $_POST['cus_id'];
$pet_age = $_POST['pet_age'];

if (!empty($cus_id)) {


    $day = substr($pet_age, 0, 2);
    $month = substr($pet_age, 3, 2);
    $year = substr($pet_age, 6, 4);
    $pet_age1 = $year . "-" . $month . "-" . $day;


    if ($_FILES['pet_picture']['name']) {//ถ้าไม่มีการส่งไฟล์รูปมา
        $pic_name = $_FILES['pet_picture']['name'];//ชื่อไฟล์
        $pic_tmp = $_FILES['pet_picture']['tmp_name'];//ตำแหน่งของ tempfile
        $pic_size = $_FILES['pet_picture']['size'];//ความจุของไฟล์
        $pic_type = $_FILES['pet_picture']['type'];//ประเภทของไฟล์


//        if ($pic_type != "image/jpeg") {//ชนิดของภาพต้องเป็นรูปภาพแบบ jpg
//            echo "<p>รูปภาพสินค้าต้องเป็นรูปชนิด JPEG เท่านั้น</p>";
//            echo "<p>กรุณาเลือกรูปภาพใหม่ == >  <a href='index.php?module=pet&action=pet_manage&active=active5'>กลับไปกรอกข้อมูล</a></p>";
//            $check_pic = false;
//        }

            copy($pic_tmp, "../module/images/$pic_name");//copy("1ต้นทางจากที่ไหน","2ปลายทางไว้ที่ไหน")
            $images = "../module/images/$pic_name";

            $width = 94; //*** กำหนดความกว้าง ความสูงคำนวนอัตโนมัติ ให้ได้สัดส่วน ***/


            $size = GetimageSize($images);
            $height = round($width * $size[1] / $size[0]);
            $images_orig = ImageCreateFromJPEG($images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            ImageDestroy($images_orig);




    } else {
        $pic_name = '';

    }


    $sql_pet = "INSERT INTO pet(pet_name,pet_type,pet_species,pet_birthday,pet_sex,pet_picture,cus_id)
values('$_POST[pet_name]','$_POST[pet_type]','$_POST[pet_species]','$pet_age1','$_POST[pet_sex]','$pic_name','$cus_id')";

    if (mysqli_query($conn,$sql_pet) or die(mysql_error())) {


        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<script>window.location='index.php?module=pet&action=pet_manage&active=active5'</script>";

    } else {
        echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
        echo "<script>window.location='index.php?module=pet&action=pet_manage&active=active5'</script>";
    }

} else {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน')</script>";
    echo "<script>window.location='index.php?module=pet&action=pet_manage&active=active5'</script>";


}


?>
