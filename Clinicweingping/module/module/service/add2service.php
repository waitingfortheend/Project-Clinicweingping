<?php


if (empty($_POST['pet'])) {

    echo "<script>alert('กรุณาเลือกสัตว์')</script>";
    echo "<script>window.location='index.php?module=service&action=service_pet_manage&active=active12'</script>";


} else {


    $count = count($_POST['pet']);


    for ($i = 0; $i < $count; $i++) {


        if (empty($_POST['pet'][$i]) or empty($_SESSION['spet_id'])) {//ถ้าตระกร้าสินค้าว่าง

            $_SESSION['spet_id'] = array();//กำหนดให้ เป็น array
            $_SESSION['spet_name'] = array();
            $_SESSION['scus_id'] = array();

        }

        $pet_ids = $_POST['pet'][$i];
        if (!in_array($_POST['pet'][$i], $_SESSION['spet_id'])) {//ถ้า product_id ที่ส่งมา ไม่ซ้ำใน session จะเพิ่มในอาเรย์
            $sql_pet = mysqli_query($conn,"select * from pet where pet_id='$pet_ids' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
            list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);


            $_SESSION['spet_id'][] = $pet_id;
            $_SESSION['spet_name'][] = $pet_name;
            $_SESSION['scus_id'][] = $cus_id;

        }

    }


    echo "<script>window.location='index.php?module=service&action=show_service&active=active12'</script>";


}

?>
