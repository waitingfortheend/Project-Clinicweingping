<?php


$mfg = $_POST['mfg'];
$exp = $_POST['exp'];



$mfg0 = explode("/", $mfg);

$day1 = $mfg0[0];
$month1 = $mfg0[1];
$year1 = $mfg0[2];

$exp0 = explode("/", $exp);

$day2 = $exp0[0];
$month2 = $exp0[1];
$year2 = $exp0[2];

$mfg1 = $year1 . "-" . $month1 . "-" . $day1;

$exp1 = $year2 . "-" . $month2 . "-" . $day2;

if ($_FILES['d_picture']['name']) {//ถ้าไม่มีการส่งไฟล์รูปมา
    $pic_name = $_FILES['d_picture']['name'];//ชื่อไฟล์
    $pic_tmp = $_FILES['d_picture']['tmp_name'];//ตำแหน่งของ tempfile
    $pic_size = $_FILES['d_picture']['size'];//ความจุของไฟล์
    $pic_type = $_FILES['d_picture']['type'];//ประเภทของไฟล์

    $update_pic = ",d_picture='$pic_name'";



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

    $picname = "";
    $update_pic = "";
}


$sql = ("UPDATE drug SET name_eng='$_POST[d_eng]',name_thai='$_POST[d_th]',detail='$_POST[d_detail]',price='$_POST[d_price]',sprice='$_POST[d_sprice]',amount='$_POST[d_amount]',unit='$_POST[d_unit]',mfg='$mfg1',exp='$exp1',type_d_id='$_POST[type_d_id]'$update_pic WHERE d_id = '$_POST[d_id]'");

if (mysqli_query($conn,$sql) or die(mysql_error())) {
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=drug&action=drug_manage&active=active7'</script>";


} else {
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
    echo "<script>window.location='index.php?module=drug&action=drug_manage&active=active7'</script>";
}


?>
