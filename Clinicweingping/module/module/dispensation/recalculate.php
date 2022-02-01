<?php


if ($_POST['button'] == "คำนวณใหม่") {

    if (isset($_POST['cancel_id'])) {

        $cnt = count($_SESSION['sdrug_id']);

        if ($cnt >= 0) {


            for ($i = 0; $i < $cnt; $i++) {

                if (!in_array($_SESSION['sdrug_id'][$i], $_POST['cancel_id'])) {
                    $tdrug_id[] = $_SESSION['sdrug_id'][$i];
                    $tdrug_name_eng[] = $_SESSION['drug_name_eng'][$i];
                    $tdrug_price[] = $_SESSION['drug_price'][$i];
                    $tdrug_amount[] = $_SESSION['drug_amount'][$i];

                }

            }

        }

        if (empty($tdrug_id)) {
            $tdrug_id = "";
        }
        if (empty($tdrug_name_eng)) {
            $tdrug_name_eng = "";
        }
        if (empty($tdrug_price)) {
            $tdrug_price = "";
        }
        if (empty($tdrug_amount)) {
            $tdrug_amount = "";
        }
        $_SESSION['sdrug_id'] = $tdrug_id;
        $_SESSION['drug_name_eng'] = $tdrug_name_eng;
        $_SESSION['drug_price'] = $tdrug_price;
        $_SESSION['drug_amount'] = $tdrug_amount;

    }

//นำค่าจำนวนสินค้าที่ส่งจากฟอร์มเก็บเข้าไปแทนใน session

    for($i=0;$i<count($_POST['amount']);$i++){

    if( $_SESSION['all'][$i] >= $_POST['amount'][$i] and $_POST['amount'][$i]>=1   ){

        $_SESSION['drug_amount'][$i] = $_POST['amount'][$i];

    }else{
       ?>

        <script>

            alert("<?php  echo "จำนวน".$_SESSION['sdrug_id'][$i]." คงเหลือ "
                .$_SESSION['all'][$i] . $_SESSION['unit'][$i]
                ?>");
        </script>

        <?php
        $_SESSION['drug_amount'][$i] = 1;

    }


    }


    echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active16'</script>";


} elseif ($_POST['button'] == "ยืนยันการขายยา") {

    $total = $_POST['total_price'];
    echo "<script>window.location='index.php?module=dispensation&action=insert_dispensation_drug&active=active16&total=$total'</script>";

}


?>
