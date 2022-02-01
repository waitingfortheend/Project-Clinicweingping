<?php

$buy_id = $_GET['buy_id'];


$sql_buy = mysqli_query($conn,"select * from buy_detail WHERE buy_id='$buy_id'");



$buy = ("UPDATE buy SET status='1' WHERE buy_id ='$buy_id'");
mysqli_query($conn,$buy) or die(mysql_error());
$count = mysqli_num_rows($sql_buy);
$i=0;

while (list($buy_id, $d_id, $b_price, $b_amount) = mysqli_fetch_array($sql_buy) or die(mysql_error())) {

    $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$d_id'") or die(" sql_d = " . mysql_error());
    list($d_amount) = mysqli_fetch_array($sql_d);
    $sum_amount = $d_amount + $b_amount;

    $sql_drug = ("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$d_id'");
    mysqli_query($conn,$sql_drug) or die(mysql_error());

    $i++;

    
    if($i==$count){
        echo "<script>alert('ยืนยันการสั่งซื้อเรียบร้อยแล้ว')</script>";
        echo "<script>window.location='index.php?module=buy&action=buy_manage&active=active9'</script>";

    }

}




?>