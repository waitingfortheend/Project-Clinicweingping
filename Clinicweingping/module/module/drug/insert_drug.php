<?php

         $d_mfg = $_POST['mfg'];
         $d_exp = $_POST['exp'];



         $drug_mfg = explode("/",$d_mfg);
         $day  = $drug_mfg[0];
         $month = $drug_mfg[1];
         $year = $drug_mfg[2];

         $mfg1 = $year."-".$month."-".$day;

        $drug_mfg = explode("/",$d_exp);
        $day2  = $drug_mfg[0];
        $month2 = $drug_mfg[1];
        $year2 = $drug_mfg[2];


         $exp1 = $year2."-".$month2."-".$day2;


         if($_FILES['d_picture']['name']){//ถ้าไม่มีการส่งไฟล์รูปมา
         $pic_name=$_FILES['d_picture']['name'];//ชื่อไฟล์
         $pic_tmp=$_FILES['d_picture']['tmp_name'];//ตำแหน่งของ tempfile
         $pic_size=$_FILES['d_picture']['size'];//ความจุของไฟล์
         $pic_type=$_FILES['d_picture']['type'];//ประเภทของไฟล์



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
      	$pic_name='';

      	}

$d_id = $_POST['d_id'];


$sql_drug = "INSERT INTO drug(d_id,name_eng,name_thai,detail,price,sprice,amount,unit,mfg,exp,d_picture,type_d_id) values('$d_id','$_POST[d_eng]','$_POST[d_th]','$_POST[d_detail]','$_POST[d_price]','$_POST[d_sprice]','$_POST[d_amount]','$_POST[d_unit]','$mfg1','$exp1','$pic_name','$_POST[type_d_id]')";



if(mysqli_query($conn,$sql_drug)or die(mysql_error())){

   echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
   echo "<script>window.location='index.php?module=drug&action=drug_manage&active=active7'</script>";

}else{
   echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
      echo "<script>window.location='index.php?module=drug&action=drug_manage&active=active7'</script>";
}












 ?>
