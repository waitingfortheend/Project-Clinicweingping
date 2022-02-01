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
$treat_drug_id = $_POST['treat_drug_id'];


$sql_treat_drug_id = mysqli_query($conn,"select * from treatment_drug where treat_drug_id='$treat_drug_id'");



list($t_d_id,$d_id,$amount,$stotal,$t_date)= mysqli_fetch_array($sql_treat_drug_id);



?>







        <div class="table-responsive" id="divprint" >
        <tr><th><center style="font-size: 15px;">คลินิคเวียงพิงค์รักษาสัตว์</center></th></tr>
        <tr><th><center style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</center></th></tr>
        <tr><th><center style="font-size: 15px;">โทร. 053-242-417</center></th></tr>
        <div class="hr-line-dashed"></div>


            <?php
            $dis_date = explode(" ",$t_date);
            $bdate = explode("-",$dis_date[0]);
            $year = $bdate[0];
            $month = $bdate[1];
            $day = $bdate[2];

            $date1 = $day."-".$month."-".$year . " " . $dis_date[1];

            ?>
            
        <tr><th> <left style="font-size: 13px;">รหัสการขายยา <?php echo $t_d_id; ?> </left></th></tr><br>
        <tr><th> <left style="font-size: 13px;">วันที่ <?php echo $date1 ?></left></th></tr><br>

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>


                            <th>รหัสยา </th>
                            <th>ชื่อยา </th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ราคารวม</th>


                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $sum=0;

                        $sql2 = mysqli_query($conn,"select * from treatment_drug where treat_drug_id='$treat_drug_id'");



                        while(list($t_d_id,$d_id,$amount,$total,$t_date)= mysqli_fetch_array($sql2)){


                            $sql_d = mysqli_query($conn,"select * from drug where d_id='$d_id'");

                            list($d_id,$d_eng,$d_th,$d_detail,$d_price,$s_price,$amount2,$unit,$mfg,$exp,$picture,$type)=mysqli_fetch_array($sql_d); //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            $sum+= $amount*$s_price;
                            ?>

                            <tr>

                                <td><?php echo $d_id; ?></td>
                                <td><?php echo $d_eng; ?><small><?php echo "<br>". $d_th; ?></small></td>

                                <td><?php echo $amount . " ".$unit; ?></td>
                                <td style="text-align: right"><?php echo $s_price." บาท"; ?></td>
                                <td style="text-align: right"><?php echo $amount*$s_price; ?>.00 บาท</td>

                            </tr>


                            <?php



                        }


                        echo"<tr>


                     <td colspan='4' style='text-align:right;font-weight:bold';>รวมทั้งหมด</td> <td style=\"text-align: right\">";
                        printf("%.2f",$sum);
                        echo " บาท</td></tr>";
                        echo "<tr>";


                        ?>


                            <td colspan="4" style="text-align: center"> <?php echo "(" . convert(number_format($sum, 2)) . ")"; ?></td>
                            <?php
                            echo "</tr>";
                            ?>


                        </tbody>

                        <?php

                        ?>


                    </table>
                </div>


