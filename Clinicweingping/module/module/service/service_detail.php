<?php
include ("../../include/connect_db.php");



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
   $ser_id = $_POST['serid'];

   $sql_s = mysqli_query($conn,"select * from service where ser_id='$ser_id'");



   list($ser_id,$ser_date,$s_total)= mysqli_fetch_array($sql_s) ;


 ?>


<div id="divprint">

                                        <center> <h2 colspan="6" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</h2></center>
                                        <center><h3 colspan="6" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่ </h3></center>
                                        <center><h3 colspan="6" style="font-size: 15px;">โทร. 053-242-417</h3></center>

                                        <div class="hr-line-dashed"></div>

                                        <h3>รหัสการบริการ <?php echo $ser_id; ?> </h3>


                                        <?php
                                        $s_date = explode(" ",$ser_date);
                                        $bdate = explode("-",$s_date[0]);
                                        $year = $bdate[0];
                                        $month = $bdate[1];
                                        $day = $bdate[2];

                                        $s_date = $day."-".$month."-".$year . " " . $s_date[1];

                                        ?>
                                        <h4>วันที่ <?php echo $s_date ?></h4>




                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>


                                                    <th>รหัสสัตว์ </th>
                                                    <th>ชื่อสัตว์ </th>
                                                    <th>รายละเอียด</th>
                                                    <th>ราคา</th>


                                                </tr>
                                                </thead>
                                                <tbody>

                           <?php


                           $sql_sd = mysqli_query($conn,"select * from service_detail where ser_id='$ser_id'");



                           while(list($ser_id,$ser_detail,$ser_price,$pet_id)= mysqli_fetch_array($sql_sd)){


                           $sql_d = mysqli_query($conn,"select * from pet where pet_id='$pet_id'");

                           list($pet_id,$pet_name,$pet_type,$pet_species,$pet_age,$pet_sex,$pet_picture,$pet_cus_id)=mysqli_fetch_array($sql_d) //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว




                            ?>

                                                <tr>

                                                    <td><?php echo $pet_id; ?></td>
                                                    <td><?php echo $pet_name; ?><small></small></td>
                                                    <td><?php echo $ser_detail; ?></td>
                                                    <td style="text-align: right"><?php echo $ser_price." บาท"; ?></td>


                                                      </tr>


                  <?php



                     }

                     echo"<tr>


                     <td colspan='3' style='text-align:right;font-weight:bold';>รวมทั้งหมด</td> <td style=\"text-align: right\">";
                     printf("%.2f",$s_total);
                     echo " บาท</td></tr>";


                   ?>

                           <tr><td colspan="3" style="text-align: center"> <?php echo "(" . convert(number_format($s_total, 2)) . ")"; ?></td>

                           </tr>


                                                </tbody>

                                             <?php

                                                 ?>


                                            </table>
                                        </div>


</div>
