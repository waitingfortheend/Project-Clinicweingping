<?php

$cnt = count($_SESSION['sdrug_id']);

    $treat_exa = $_SESSION['treat_exa'];
    $treat_sick = $_SESSION['treat_sick'];
    $treat_judge = $_SESSION['treat_judge'];
    $treat_price = $_SESSION['treat_price'];
    $p_id = $_SESSION['p_id'];
    $t_id = $_SESSION['t_id'];



    if(!empty($_SESSION['chkapp'])){
        $chkapp = $_SESSION['chkapp'];
}
    if(!empty($_SESSION['app'])){
        $app = $_SESSION['app'];
    }
    if(!empty($_SESSION['app_detail'])){
        $app_detail = $_SESSION['app_detail'];

    }
    if(!empty($_SESSION['time'])){

    $time = $_SESSION['time'];

    }

for ($i = 0; $i < $cnt; $i++) {
    if ($_SESSION['drug_amount'][$i] < 1) {


        echo "<script>alert('กรุณากรอกจำนวนให้ครบ')</script>";
        echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active15'</script>";
        break;
    } elseif (empty($_SESSION['drug_amount'][$i])) {

        echo "<script>alert('กรุณากรอกจำนวนให้ครบ')</script>";
        echo "<script>window.location='index.php?module=dispensation&action=show_cart&active=active15'</script>";
        break;
    } else {

        $ok = "1";
    }


}

if ($ok == "1") {
    $dis_date = date("Y-m-d H:i:s");


    $drug_id = "D" . sprintf("%05d", substr($_SESSION['sdrug_id'][0], -5));
    $price = $_SESSION['drug_price'][0];
    $amount = $_SESSION['drug_amount'][0];

    $suumprice = $price*$amount;

    $sqlse = mysqli_query($conn,"SELECT MAX(treat_drug_id) FROM treatment_drug");
    list($MAX) = mysqli_fetch_row($sqlse);

    $MAX2 = "P" . sprintf("%06d", substr($MAX, -6) + 1);

    $sql2 = "INSERT INTO treatment_drug(treat_drug_id,d_id,amount,total,t_date) VALUES('$MAX2','$drug_id','$amount','$suumprice','$dis_date')";


    $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$drug_id'") or die(" sql_d = " . mysql_error());
    list($d_amount) = mysqli_fetch_row($sql_d);

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
        list($d_amount) = mysqli_fetch_row($sql_d);
        $sum_amount = $d_amount - $amount;
        $sql_drug = ("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$drug_id'");
        mysqli_query($conn,$sql_drug) or die(mysql_error());


    }


    mysqli_query($conn,$sql2) or die("sql2 =" . mysql_error());



    $sql_treat = mysqli_query($conn,"Select  Max(substr(treat_id,-6))+1 as treat_id from treatment") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

    while ($row = mysqli_fetch_assoc($sql_treat))
    {
    //    echo $row['treat_id'];
       $new_id =  $row['treat_id'];
       if ($new_id == 0) { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
        $t_id = "T000001";
        } else {
            $t_id = "T" . sprintf("%06d", $new_id);//ถ้าไม่ใช่ค่าว่าง
        }
    
    
    
    }


$today = date("Y-m-d H:i:s");


$sql3 = "INSERT INTO treatment(treat_id,pet_id,treat_date,examination,sick,judge,cash_total,treat_drug_id) VALUES('$t_id','$p_id','$today','$treat_exa','$treat_sick','$treat_judge','$treat_price','$MAX2')";

mysqli_query($conn,$sql3) or die("sql3 =" . mysql_error());


}

$appchk="";

if (!empty($chkapp)) {


    $appdate = explode('/', $app);
    $month = $appdate[0];
    $day   = $appdate[1];
    $year  = $appdate[2];
    $time2 = explode(':',$time);
    $hour = $time2[0];
    $minit = $time2[1];



    $appdate = $year."/".$month."/".$day." ".$hour.":".$minit.":"."00";



    $sql4 = "INSERT INTO appointment(pet_id,app_date,app_detail) VALUES('$p_id','$appdate','$app_detail')";
    mysqli_query($conn,$sql4) or die("sql3 =" . mysql_error());
    $app = "การนัดหมาย";

}






        unset($_SESSION['sdrug_id']);
        unset($_SESSION['drug_name_eng']);
        unset($_SESSION['drug_price']);
        unset($_SESSION['drug_amount']);
        unset($_SESSION['treat_exa']);
        unset($_SESSION['treat_sick']);
        unset($_SESSION['treat_judge']);
        unset($_SESSION['treat_price']);
        unset($_SESSION['p_id']);
        unset($_SESSION['t_id']);
        unset($_SESSION['all']);
        unset($_SESSION['unit']);
        unset($_SESSION['chkapp']);
        unset($_SESSION['app']);
        unset($_SESSION['app_detail']);
        unset($_SESSION['time']);


echo "<script>alert('บันทึกการรักษา $appchk และการจ่ายยาเรียบร้อยแล้ว')</script>";
echo "<script>window.location='index.php?module=treatment&action=treatment_manage&active=active13'</script>";


?>