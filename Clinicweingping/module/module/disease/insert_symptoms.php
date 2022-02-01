<?php


$diseasetypeid = $_POST['diseasetypeid'];
$sym_detail = $_POST['sym_detail'];

$type_pet = $_POST['type_pet'];



//    echo $diseasetypeid;
//    echo $sym_detail;

if (strstr($sym_detail, ",")) {

    $sym = explode(",", $sym_detail);
    $count = count($sym);

    $sql_sym = "INSERT INTO symptoms(sym_detail,diseasetypeid) values('$sym[0]','$diseasetypeid')";
    for ($i = 1; $i < $count; $i++) {


        $sql_sym .= ",('$sym[$i]','$diseasetypeid')";

    }

    mysqli_query($conn,$sql_sym) or die(mysql_error());

    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";


}else {


    $sql_sym = "INSERT INTO symptoms(sym_detail,diseasetypeid) values('$sym_detail','$diseasetypeid')";

    mysqli_query($conn,$sql_sym) or die(mysql_error());


    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";



}


?>