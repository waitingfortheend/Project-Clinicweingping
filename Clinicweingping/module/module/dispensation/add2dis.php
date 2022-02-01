<?php


if (empty($_POST['drug'])) {

    echo "<script>alert('กรุณาเลือกยาที่ต้องการขายยา')</script>";
    echo "<script>window.location='index.php?module=dispensation&action=dispensation_drug_manage&active=active15'</script>";


} else {


    $count = count($_POST['drug']);


    for ($i = 0; $i < $count; $i++) {


        if (empty($_POST['drug'][$i]) or empty($_SESSION['sdrug_id'])) {//ถ้าตระกร้าสินค้าว่าง

            $_SESSION['sdrug_id'] = array();//กำหนดให้ เป็น array
            $_SESSION['drug_name_eng'] = array();
            $_SESSION['drug_price'] = array();
            $_SESSION['all'] = array();
            $_SESSION['unit'] = array();
            $_SESSION['drug_amount'] = array();
        }
        $d_id = $_POST['drug'][$i];
        if (!in_array($_POST['drug'][$i], $_SESSION['sdrug_id'])) {//ถ้า product_id ที่ส่งมา ไม่ซ้ำใน session จะเพิ่มในอาเรย์
            $sql_drug = mysqli_query($conn,"select * from drug where d_id='$d_id' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
            list($d_id, $d_eng, $d_th, $d_detail, $d_price, $d_sprice, $a, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug);


            $_SESSION['sdrug_id'][] = $d_id;
            $_SESSION['drug_name_eng'][] = $d_eng;
            $_SESSION['drug_price'][] = $d_sprice;
            $_SESSION['all'][] = $a;
            $_SESSION['unit'][] = $unit;
            $_SESSION['drug_amount'][] = 1;

        }


    }


    echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active16'</script>";

}


?>
