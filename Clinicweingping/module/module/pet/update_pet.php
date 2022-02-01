
<?php

         $pet_age = $_POST['pet_age'];

         $day = substr($pet_age, 0, 2);
         $month = substr($pet_age, 3, 2);
         $year = substr($pet_age, 6, 4);
         $pet_age1 = $year."-".$month."-".$day;


      if($_FILES['pet_picture']['name']){//ถ้าไม่มีการส่งไฟล์รูปมา
      $pic_name=$_FILES['pet_picture']['name'];//ชื่อไฟล์
      $pic_tmp=$_FILES['pet_picture']['tmp_name'];//ตำแหน่งของ tempfile
      $pic_size=$_FILES['pet_picture']['size'];//ความจุของไฟล์
      $pic_type=$_FILES['pet_picture']['type'];//ประเภทของไฟล์


      $update_pic =",pet_picture='$pic_name'";



         copy($pic_tmp,"../module/images/$pic_name");//copy("1ต้นทางจากที่ไหน","2ปลายทางไว้ที่ไหน")
         $images ="../module/images/$pic_name";

         $width=94; //*** กำหนดความกว้าง ความสูงคำนวนอัตโนมัติ ให้ได้สัดส่วน ***/



         $size=GetimageSize($images);
         $height=round($width*$size[1]/$size[0]);
         $images_orig = ImageCreateFromJPEG($images);
         $photoX = ImagesX($images_orig);
         $photoY = ImagesY($images_orig);
         ImageDestroy($images_orig);

    


      }else{

         $picname ="";
         $update_pic="";
      }

      $pet_age =  $_POST['pet_age'];


$sql =("UPDATE pet SET pet_name='$_POST[pet_name]',pet_type='$_POST[pet_type]',pet_species='$_POST[pet_species]',pet_birthday='$pet_age1',pet_sex='$_POST[pet_sex]',cus_id='$_POST[cus_id]'$update_pic WHERE pet_id = '$_POST[pet_id]'");

if(mysqli_query($conn,$sql)or die(mysql_error())  ){
   echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=pet&action=pet_manage&active=active5'</script>";


}else{
   echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
   echo "<script>window.location='index.php'</script>";
}









 ?>
