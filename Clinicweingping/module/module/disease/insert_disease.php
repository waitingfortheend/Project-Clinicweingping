<?php

$type_pet = $_POST['type_pet'];
$diseasetypename = $_POST['diseasetypename'];
$diseasedetail = $_POST['diseasedetail'];
$sym_detail = $_POST['sym_detail'];


if (strstr($sym_detail, ",")) {


    $sql_disease = "INSERT INTO diseasetype(diseasetypename,curedisease,pet_type) values('$diseasetypename','$diseasedetail','$type_pet')";
    $sym = explode(",", $sym_detail);
    $count = count($sym);

    if (mysqli_query($conn,$sql_disease) or die(mysql_error())) {

        $select_dis = mysqli_query($conn,"select max(diseasetypeid) from diseasetype");
        list($distype) = mysqli_fetch_array($select_dis);

        $sql_sym = "INSERT INTO symptoms(sym_detail,diseasetypeid) values('$sym[0]','$distype')";
        for ($i = 1; $i < $count; $i++) {


            $sql_sym .= ",('$sym[$i]','$distype')";

        }

        mysqli_query($conn,$sql_sym) or die(mysql_error());


        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";

    } else {
        echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
        echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";
    }


} else {


    $sql_disease = "INSERT INTO diseasetype(diseasetypename,curedisease,pet_type) values('$diseasetypename','$diseasedetail','$type_pet')";

    if (mysqli_query($conn,$sql_disease) or die(mysql_error())) {

        $select_dis = mysqli_query($conn,"select max(diseasetypeid) from diseasetype");
        list($distype) = mysqli_fetch_array($select_dis);

        $sql_sym = "INSERT INTO symptoms(sym_detail,diseasetypeid) values('$sym_detail','$distype')";

        mysqli_query($conn,$sql_sym) or die(mysql_error());


        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";

    } else {
        echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
        echo "<script>window.location='index.php?module=disease&action=disease_manage&active=active26'</script>";
    }

}


?>