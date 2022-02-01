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
$treat_id = $_POST['treat_id'];

$sql_treatment = mysqli_query($conn,"select * from treatment where treat_id='$treat_id'");


list($treat_id, $pet_id, $treat_date, $exa, $sick, $jude, $cash_total) = mysqli_fetch_array($sql_treatment);


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
                <tr><th> <left style="font-size: 13px;">รหัสการรักษา <?php echo $treat_id; ?> </left></th></tr><br>


                <?php
                $t_date = explode(" ",$treat_date);
                $bdate = explode("-",$t_date[0]);
                $year = $bdate[0];
                $month = $bdate[1];
                $day = $bdate[2];

                $tre_date = $day."-".$month."-".$year . " " . $t_date[1];

                ?>

                <tr><th> <left style="font-size: 13px;">วันที่รักษา <?php echo $tre_date ?></left></th></tr><br>


                <table class="table table-striped table-bordered table-hover">


                    <thead>
                    <tr>


                        <th>รหัสสัตว์</th>
                        <th>ชื่อสัตว์</th>
                        <th>การตรวจร่างกาย</th>
                        <th>อาการ</th>
                        <th>วินิจฉัย</th>
                        <th>ค่ารักษา</th>


                    </tr>
                    </thead>
                    <tbody>

                    <?php


                    $sql_treatment = mysqli_query($conn,"select * from treatment where treat_id='$treat_id'");
                    $sum = 0;


                    list($treat_id, $pet_id, $treat_date, $exa, $sick, $jude, $cash_total, $treat_drug_id) = mysqli_fetch_array($sql_treatment);


                                            $sql_d = mysqli_query($conn,"select * from pet where pet_id='$pet_id'");

                                            list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $pet_cus_id) = mysqli_fetch_array($sql_d) //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                    ?>

                    <tr>

                        <td><?php echo $pet_id; ?></td>
                        <td><?php echo $pet_name; ?>
                            <small></small>
                        </td>
                        <td><?php echo $exa; ?></td>

                        <td><?php echo $sick; ?></td>

                        <td><?php echo $jude; ?></td>


                        <td style="text-align: right"><?php echo $cash_total . " บาท"; ?></td>


                    </tr>


                    <?php
                    $sum = $cash_total;

                    echo "</table>";

                    echo "<table class=\"table table-striped table-bordered table-hover\"><tr>
                            <th>รหัสยา</th><th colspan='2'>ชื่อยา</th><th>จำนวน</th><th>ราคา</th><th>ราคารวม</th>
                        
                        </tr>";

                    echo "<tr>";

                    $sql2 = mysqli_query($conn,"select * from treatment_drug where treat_drug_id='$treat_drug_id'");



                    while(list($t_d_id,$d_id,$amount,$total,$t_date)= mysqli_fetch_array($sql2)){


                        $sql_d = mysqli_query($conn,"select * from drug where d_id='$d_id'");

                        list($d_id,$d_eng,$d_th,$d_detail,$d_price,$s_price,$amount2,$unit,$mfg,$exp,$picture,$type)=mysqli_fetch_array($sql_d); //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                        $sum+= $amount*$s_price;
                        ?>

                        <tr>

                            <td><?php echo $d_id; ?></td>
                            <td colspan="2"><?php echo $d_eng; ?><small><?php echo "<br>". $d_th; ?></small></td>

                            <td><?php echo $amount . " ".$unit; ?></td>
                            <td style="text-align: right"><?php echo $s_price." บาท"; ?></td>
                            <td style="text-align: right"><?php echo $amount*$s_price; ?>.00 บาท</td>

                        </tr>


                        <?php



                    }




                    echo "</tr>";

                    echo " <td colspan='5' style='text-align:right;font-weight:bold';>รวมทั้งหมด</td> <td style=\"text-align: right\">";
                    printf("%.2f", $sum);
                    echo " บาท</td></tr>";


                    ?>

                    <tr>
                        <td colspan="5"
                            style="text-align: center"> <?php echo "(" . convert(number_format($sum, 2)) . ")"; ?></td>

                    </tr>


                    </tbody>

                    <?php

                    ?>


                </table>
            </div>

<!--        </div>-->
<!--    </div>-->
<!--</div>-->


