<?php
include("../../include/connect_db.php");

?>


<?php

$drug_id = $_POST['d_id'];


$sql_drug = mysqli_query($conn,"select * from drug where d_id='$drug_id' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


list($d_id, $d_eng, $d_th, $d_detail, $d_price, $d_sprice, $amount, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug);


?>


<center>

    <?php


    ?>

    <?php

    if (empty($picture)) {
        $picture = "no-pd.jpg";

    }
    echo "<img alt='image' class='img-responsive' width='150px' heigh='50px'  src='images/$picture'>";

    ?>
</center>

<br>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example ">
        <tr><th width="30%">ชื่อยา</th><td><?php echo $d_th . " ( " . $d_eng . " ) " ?></td></tr>
        <tr><th width="10%">รายละเอียด</th><td><?php echo $d_detail; ?></td></tr>
        <tr><th width="10%">ราคาซื้อ</th><td><?php echo $d_price. " บาท"; ?></td></tr>
        <tr><th width="10%">ราคาขาย</th><td><?php echo $d_sprice. " บาท"; ?></td></tr>
        <tr><th width="10%">คงเหลือ</th><td><?php echo $amount." ".$unit  ?></td></tr>

        <?php

        $bdate = explode("-",$mfg);
        $year = $bdate[0];
        $month = $bdate[1];
        $day = $bdate[2];

        $mfg_date = $day."-".$month."-".$year ;


        $bdate = explode("-",$exp);
        $year = $bdate[0];
        $month = $bdate[1];
        $day = $bdate[2];

        $exp_date = $day."-".$month."-".$year ;

        ?>

        <tr><th width="10%">วันที่ผลิต</th><td><?php echo $mfg_date ?></td></tr>


        <tr><th width="10%">วันหมดอายุ</th><td><?php echo $exp_date  ?></td></tr>

    </table>
</div>

