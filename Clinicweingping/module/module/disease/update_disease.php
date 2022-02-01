<?php


$dis_id = $_POST['id'];

$type_pet = $_POST['type_pet'];
$diseasetypename = $_POST['diseasetypename'];
$diseasedetail = $_POST['diseasedetail'];

$sym_id = $_POST['sym_id'];
$sym_detail = $_POST['symdetail'];

$count = count($sym_detail);


for($i=0;$i<$count;$i++){

    if(empty($sym_detail[$i])){

        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน')</script>";
        echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";
        break;
    }else{

        $sql_sym = ("UPDATE symptoms SET sym_detail='$sym_detail[$i]' WHERE sym_id = '$sym_id[$i]'");
        mysqli_query($conn,$sql_sym) or die(mysql_error());

    }
}





$sql_dis =("UPDATE diseasetype SET diseasetypename='$diseasetypename',curedisease='$diseasedetail',pet_type='$type_pet' WHERE diseasetypeid = '$dis_id'");
if (mysqli_query($conn,$sql_dis) or die(mysql_error())) {
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";


} else {
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้')</script>";
    echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";
}



//echo $type_pet."<br>";
//echo $diseasetypename."<br>";
//echo $diseasedetail."<br>";









echo $count;




?>

