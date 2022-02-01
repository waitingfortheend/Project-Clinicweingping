
<?php
$total =  $_GET['total'];
$cnt = count($_SESSION['sdrug_id']);


for($i=0;$i<$cnt;$i++){
    if($_SESSION['drug_amount'][$i]< 1){


        echo "<script>alert('กรุณากรอกจำนวนให้ครบ')</script>";
        echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active15'</script>";
        break;
    }elseif (empty($_SESSION['drug_amount'][$i])){

        echo "<script>alert('กรุณากรอกจำนวนให้ครบ')</script>";
        echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active15'</script>";
        break;
    }else{

        $ok ="1";
    }



}


if($ok=="1"){

    $suumprice=0;

    $dis_date = date("Y-m-d H:i:s");


    $drug_id = "D" . sprintf("%05d", substr($_SESSION['sdrug_id'][0], -5));
    $price = $_SESSION['drug_price'][0];
    $amount = $_SESSION['drug_amount'][0];

    $suumprice = $price*$amount;

    $sqlse = mysqli_query($conn,"SELECT MAX(treat_drug_id) FROM treatment_drug");
    list($MAX) = mysqli_fetch_array($sqlse);

    $MAX2 = "P" . sprintf("%06d", substr($MAX, -6) + 1);

    $sql2 = "INSERT INTO treatment_drug(treat_drug_id,d_id,amount,total,t_date) VALUES('$MAX2','$drug_id','$amount','$suumprice','$dis_date')";


    $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$drug_id'") or die(" sql_d = " . mysql_error());
    list($d_amount) = mysqli_fetch_array($sql_d);

    $sum_amount = $d_amount - $amount;

    $sql_drug = ("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$drug_id'");
    mysqli_query($conn,$sql_drug) or die(mysql_error());


    for ($i = 1; $i < $cnt; $i++) {


        $drug_id = "D" . sprintf("%05d", substr($_SESSION['sdrug_id'][$i], -5));
        $price = $_SESSION['drug_price'][$i];
        $amount = $_SESSION['drug_amount'][$i];

        $suumprice = $price*$amount;

        $sql2 .= ",('$MAX2','$drug_id','$amount','$suumprice','$dis_date')";

        $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$drug_id'") or die(" sql_d = " . mysql_error());
        list($d_amount) = mysqli_fetch_array($sql_d);
        $sum_amount = $d_amount - $amount;
        $sql_drug = ("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$drug_id'");
        mysqli_query($conn,$sql_drug) or die(mysql_error());


    }


mysqli_query($conn,$sql2) or die("sql2 =".mysql_error());

        unset($_SESSION['sdrug_id']);
        unset($_SESSION['drug_name_eng']);
        unset($_SESSION['drug_price']);
        unset($_SESSION['drug_amount']);

        echo "<script>alert('บันทึกการขายยาเรียบร้อยแล้ว')</script>";
        echo "<script>window.location='index.php?module=dispensation&action=dispensation_manage&active=active15'</script>";


}

?>
