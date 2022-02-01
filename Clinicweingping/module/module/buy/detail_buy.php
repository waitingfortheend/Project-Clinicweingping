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


$buy_id = $_POST['buyid'];


$sql_b = mysqli_query($conn,"select * from buy where buy_id='$buy_id'");


list($buy_id, $buy_date, $b_total) = mysqli_fetch_array($sql_b);


?>

<div id="divprint" >


            <center> <h2 colspan="6" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</h2></center>
                <center><h3 colspan="6" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่ </h3></center>
                <center><h3 colspan="6" style="font-size: 15px;">โทร. 053-242-417</h3></center>

                <div class="hr-line-dashed"></div>

                <h3>รหัสใบสั่งซื้อ <?php echo $buy_id; ?></h3>

    <?php
    $b_date = explode(" ",$buy_date);
    $bdate = explode("-",$b_date[0]);
    $year = $bdate[0];
    $month = $bdate[1];
    $day = $bdate[2];

    $buydate = $day."-".$month."-".$year." ".$b_date[1];

    ?>
                 <h4>วันที่ <?php echo $buydate ?></h4>




                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover   ">
                        <thead>
                        <tr>


                            <th>รหัสยา</th>
                            <th>ชื่อยา</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ราคารวม</th>


                        </tr>
                        </thead>
                        <tbody>

                        <?php


                        $sql_bd = mysqli_query($conn,"select * from buy_detail where buy_id='$buy_id'");


                        while (list($buy_id, $d_id, $b_price, $b_amount) = mysqli_fetch_array($sql_bd)) {

                            $sum_price = $b_price * $b_amount;
                            $sql_d = mysqli_query($conn,"select * from drug where d_id='$d_id'");

                            list($d_id, $d_eng, $d_th, $d_detail, $d_price, $s_price, $amount, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_d); //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                            ?>

                            <tr>

                                <td><?php echo $d_id; ?></td>
                                <td ><?php echo $d_eng; ?>
                                    <small><?php echo "<br>" . $d_th; ?></small>
                                </td>

                                <td><?php echo $b_amount . " " . $unit; ?></td>
                                <td style="text-align: right"><?php echo $d_price . " บาท"; ?></td>
                                <td style="text-align: right"><?php echo $sum_price; ?>.00 บาท</td>

                            </tr>


                            <?php


                        }


                        echo "<tr>


                                                      <td colspan='4' style='text-align:right;font-weight:bold';>รวมทั้งหมด</td> <td style=\"text-align: right\">";
                        printf("%.2f", $b_total);
                        echo " บาท</td></tr>";


                        echo "<tr>";

                        ?>

                        <td colspan="4" style="text-align: center"> <?php echo "(" . convert(number_format($b_total, 2)) . ")"; ?></td>
                        <?php
                        echo "</tr>";
                        ?>


                        </tbody>

                        <?php


                        ?>


                    </table>
                    </div>


</div>

