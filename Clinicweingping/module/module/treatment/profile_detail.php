<?php
include("../../include/connect_db.php");


function convert($number)
{
    $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $number = str_replace(",", "", $number);
    $number = str_replace(" ", "", $number);
    $number = str_replace("บาท", "", $number);
    $number = explode(".", $number);
    if (sizeof($number) > 2) {
        return 'ทศนิยมหลายตัวนะจ๊ะ';
        exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for ($i = 0; $i < $strlen; $i++) {
        $n = substr($number[0], $i, 1);
        if ($n != 0) {
            if ($i == ($strlen - 1) AND $n == 1) {
                $convert .= 'เอ็ด';
            } elseif ($i == ($strlen - 2) AND $n == 2) {
                $convert .= 'ยี่';
            } elseif ($i == ($strlen - 2) AND $n == 1) {
                $convert .= '';
            } else {
                $convert .= $txtnum1[$n];
            }
            $convert .= $txtnum2[$strlen - $i - 1];
        }
    }

    $convert .= 'บาท';
    if ($number[1] == '0' OR $number[1] == '00' OR
        $number[1] == ''
    ) {
        $convert .= 'ถ้วน';
    } else {
        $strlen = strlen($number[1]);
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[1], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) AND $n == 1) {
                    $convert
                        .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) AND
                    $n == 2
                ) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) AND
                    $n == 1
                ) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }
        $convert .= 'สตางค์';
    }
    return $convert;
}


?>

<?php
$pet_id = $_POST['pet_id'];

$sql_d = mysqli_query($conn,"select * from pet where pet_id='$pet_id'");

list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $pet_cus_id) = mysqli_fetch_array($sql_d) //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

?>

<!---->
<!--<div id="divprint" >-->
<!--    <div class="row m-b-lg m-t-lg" >-->
<!---->
<!--        <div class="col-lg-12">-->


<!--            <center><h2 style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</h2>-->
<!--            <h3  style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่ </h3>-->
<!--            <h3  style="font-size: 15px;">โทร. 053-242-417</h3></center>-->
<!---->
<!--            <h3>รหัสการรักษา --><?php //echo $treat_id; ?><!-- </h3>-->
<!--            <h4>วันที่รักษา --><?php //echo $treat_date ?><!--</h4>-->



<div class="table-responsive" id="divprint" >
    <tr><th><center style="font-size: 15px;">คลินิคเวียงพิงค์รักษาสัตว์</center></th></tr>
    <tr><th><center style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</center></th></tr>
    <tr><th><center style="font-size: 15px;">โทร. 053-242-417</center></th></tr>
    <div class="hr-line-dashed"></div>

    <h4><?php echo "รหัสสัตว์ \t\t". $pet_id; ?></h4>
    <h4><?php echo "ชื่อสัตว์ \t\t".$pet_name; ?></h4>
    <table class="table table-striped table-bordered table-hover">


        <thead>
        <tr>


<!--            <th>รหัสสัตว์</th>-->
<!--            <th>ชื่อสัตว์</th>-->
            <th>รหัสการรักษา</th>
            <th>วันที่รักษา</th>
            <th>การตรวจร่างกาย</th>
            <th>อาการ</th>
            <th>วินิจฉัย</th>


        </tr>
        </thead>
        <tbody>

        <?php


        $sql_treatment = mysqli_query($conn,"select * from treatment where pet_id='$pet_id' order by treat_id DESC ");
        $sum = 0;


        while (list($treat_id, $pet_id, $treat_date, $exa, $sick, $jude, $cash_total, $treat_drug_id) = mysqli_fetch_array($sql_treatment)){



        $sql_d = mysqli_query($conn,"select * from pet where pet_id='$pet_id'");

        list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $pet_cus_id) = mysqli_fetch_array($sql_d) //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


        ?>

        <tr>


                <small></small>
            </td>
            <td><?php echo $treat_id; ?></td>


            <?php
            $t_date = explode(" ",$treat_date);
            $bdate = explode("-",$t_date[0]);
            $year = $bdate[0];
            $month = $bdate[1];
            $day = $bdate[2];

            $tre_date = $day."-".$month."-".$year . " " . $t_date[1];

            ?>
            <td><?php echo $tre_date; ?></td>

            <td><?php echo $exa; ?></td>

            <td><?php echo $sick; ?></td>

            <td><?php echo $jude; ?></td>




        </tr>


        <?php

        }
        echo "</table>";



