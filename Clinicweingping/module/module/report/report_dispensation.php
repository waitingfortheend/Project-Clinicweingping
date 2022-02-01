<?php

check_type("Owner");


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

$chartN1 = "";
$chartN2 = "";

$test1 = "";
$chart1 = "";
$chart2 = "";
$test2 = "";
$chky = "";
$chkallyear = "";
?>


<div class="ibox-title">

    <h5>รายงานการขายยา</h5>
</div>
<div class="row">

    <div class="col-lg-12">
        <div class="ibox-title">

            <div class="form-group">

                <div class="input-group">
                    <label class="font-noraml">เลือกรายงาน</label>
                    <form method="post">


                        <?php
                        $chk1 = "";
                        $chk2 = "";


                        if (!empty($_GET['select1']) and $_GET['select1'] == "Month") {

                            $chk1 = "selected";
                            $select1 = 1;
                        } elseif (!empty($_GET['select1']) and $_GET['select1'] == "Year") {
                            $chk2 = "selected";
                            $select1 = 2;
                        }


                        ?>

                        <select data-placeholder="Choose a Type" class="chosen-select"
                                style="width:200px;" name="select1"
                                tabindex="2" id="mySelect" onchange="myFunction()">
                            <option value="">กรุณาเลือกประเภทรายงาน</option>
                            <option <?php echo $chk1; ?> value="Month">ประจำเดือน</option>
                            <option <?php echo $chk2; ?> value="Year">ประจำปี</option>
                        </select>

                        <?php
                        $dayOptions = '';
                        $yearOptions = '';
                        $monthnum = Array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                        $nameth = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");


                        if (!empty($select1)) {
                            if ($select1 == 1) {


                                $sql_selectMonthbuy = mysqli_query($conn,"Select t_date from treatment_drug");

                                while (list($treat_date) = mysqli_fetch_array($sql_selectMonthbuy)) {
                                    $ex = explode("-", $treat_date);
                                    $y1[] = $ex[0];

                                }


                                $nYear1 = array_unique($y1);
                                sort($nYear1);
                                $countYear1 = count($nYear1);

                                ?>


                                <label class="font-noraml">&nbsp; ปี&nbsp;</label>
                                <select data-placeholder="Choose a Year" class="chosen-select"
                                        style="width:200px;" name="select2"
                                        tabindex="2" id="mySelect2" onchange="myFunction2()">
                                    <option value="">กรุณาเลือกปี</option>

                                    <?php for ($i = 0; $i < $countYear1; $i++) {

                                        if ($_GET['select2'] == $nYear1[$i]) {
                                            $chky = "selected";
                                        } else {
                                            $chky = "";
                                        }

                                        ?>
                                        <option <?php echo $chky; ?>
                                            value="<?php echo $nYear1[$i] ?>"><?php echo $nYear1[$i] ?></option>


                                    <?php } ?>
                                </select>

                                <?php


                                if (!empty($_GET['select2'])) {
                                    $year = $_GET['select2'];

                                    $sqlMonthbuy = mysqli_query($conn,"Select t_date from treatment_drug where t_date LIKE '$_GET[select2]%'");


                                    if (!empty($sqlMonthbuy)) {


                                        while (list($dateB) = mysqli_fetch_array($sqlMonthbuy)) {
                                            $ex = explode("-", $dateB);
                                            $y1[] = $ex[0];
                                            $m1[] = $ex[1];

                                        }
                                    } else {
                                        $m1[] = array();
                                    }


                                    $arr_results = array_filter($m1);
                                    $nmmonth1 = array_unique($arr_results);
                                    sort($nmmonth1);

                                    echo "<label class=\"font-noraml\">&nbsp;เดือน&nbsp;</label>";
                                    echo "<select name=\"select2\" data-placeholder=\"Choose a Month\"  id=\"mySelect3\" onchange=\"myFunction3()\"  class=\"chosen-select\"
                                style=\"width:200px;\" tabindex=\"2\">";


                                    echo "<option value=''>กรุณาเลือกเดือน</option>";

                                    $countM = count($nmmonth1);


                                    for ($month = 0; $month <= $countM; $month++) {
                                        $monthName = date("m", mktime(0, 0, 0, $month));


                                        if ($_GET['select3'] == $nmmonth1[$month]) {
                                            $chk = "selected";
                                        } else {
                                            $chk = "";
                                        }


                                        if ($nmmonth1[$month] == 1) {
                                            $nameThai = "มกราคม";
                                        } elseif ($nmmonth1[$month] == 2) {
                                            $nameThai = "กุมภาพันธ์";
                                        } elseif ($nmmonth1[$month] == 3) {
                                            $nameThai = "มีนาคม";
                                        } elseif ($nmmonth1[$month] == 4) {
                                            $nameThai = "เมษายน";
                                        } elseif ($nmmonth1[$month] == 5) {
                                            $nameThai = "พฤษภาคม";
                                        } elseif ($nmmonth1[$month] == 6) {
                                            $nameThai = "มิถุนายน";
                                        } elseif ($nmmonth1[$month] == 7) {
                                            $nameThai = "กรกฎาคม";
                                        } elseif ($nmmonth1[$month] == 8) {
                                            $nameThai = "สิงหาคม";
                                        } elseif ($nmmonth1[$month] == 9) {
                                            $nameThai = "กันยายน";
                                        } elseif ($nmmonth1[$month] == 10) {
                                            $nameThai = "ตุลาคม";
                                        } elseif ($nmmonth1[$month] == 11) {
                                            $nameThai = "พฤศจิกายน";
                                        } elseif ($nmmonth1[$month] == 12) {
                                            $nameThai = "ธันวาคม";
                                        } else {
                                            $nameThai = "";
                                        }


                                        echo "<option  $chk value='$nmmonth1[$month]'>$nameThai</option>";
                                    }


                                    echo "</select >&nbsp;";
                                    echo "";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-success \" onClick=printDiv(\"divprint\")><i class=\"fa fa-upload\"></i> |<span
                    class=\"bold\">Print</span></button>";


                                }

                            } elseif ($select1 == 2) {

                                $sql_selectMonthbuy = mysqli_query($conn,"Select t_date from treatment_drug");

                                while (list($datebuy) = mysqli_fetch_array($sql_selectMonthbuy)) {
                                    $ex = explode("-", $datebuy);
                                    $y1[] = $ex[0];

                                }

                                $nYear1 = array_unique($y1);
                                sort($nYear1);
                                $countYear1 = count($nYear1);

                                ?>

                                <label class="font-noraml">&nbsp; ปี&nbsp;</label>
                                <select data-placeholder="Choose a Type" class="chosen-select"
                                        style="width:200px;" name="select1_2"
                                        tabindex="2" id="mySelect2" onchange="myFunction2()">
                                    <option value="">กรุณาเลือกปี</option>

                                    <?php for ($i = 0; $i < $countYear1; $i++) {

                                        if ($_GET['select2'] == $nYear1[$i]) {
                                            $chky = "selected";
                                        } elseif ($_GET['select2'] == "all") {
                                            $chkallyear = "selected";
                                        } else {
                                            $chky = "";
                                            $chkallyear = "";
                                        }

                                        ?>
                                        <option <?php echo $chky; ?>
                                            value="<?php echo $nYear1[$i] ?>"><?php echo $nYear1[$i] ?></option>


                                    <?php } ?>

                                    <option <?php echo $chkallyear; ?> value="all">ยอดรวมประจำปี</option>
                                </select>


                                <?php
                                if (!empty($_GET['select2'])) {
                                    $year = $_GET['select2'];
                                } else {
                                    $year = "";
                                }
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-success \" onClick=printDiv(\"divprint\")><i class=\"fa fa-upload\"></i> |<span
                    class=\"bold\">Print</span></button>";

                            }


                        }
                        ?>

                        <div id="demo"></div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (!empty($_GET['select1']) and $_GET['select1'] == "Month" and !empty($_GET['select2']) and !empty($_GET['select3'])) {

    ?>

    <div class="ibox-title">
        <h5>รายงานขายยาประจำเดือน</h5>

    </div>

    <div class="ibox-content" id="divprint" align="center">

        <div class="table-responsive">
            <table style="text-align: center" align="center" >
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="6" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="6">โทร. 053-242-417</td>
                </tr>
                <tbody>

                <?php
                if (!empty($_GET['select1'])) {
                    $tomonth = $_GET['select1'];
                } else {
                    $tomonth = "";
                }
                if (!empty($_GET['select3'])) {

                    $month = $_GET['select3'];
                } else {
                    $month = "";
                }
                if (!empty($_GET['select2'])) {
                    $year = $_GET['select2'];
                } else {
                    $year = "";
                }
                $sumdis = "";

                $sql = mysqli_query($conn,"SELECT  treat_drug_id,d_id,total,t_date FROM treatment_drug ORDER BY t_date ASC ");

                $Monthchart = "";
                $sumser_total = 0;


                for ($i = 0; $i <= 12; $i++) {

                    if ($month == $monthnum[$i]) {

                        $monthnameth = $nameth[$i];
                    }

                }
                ?>


                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">รายงานการขายยา
                        ประจำเดือน <?php echo $monthnameth . " " . $year; ?></td>
                </tr>


                <tr>
                    <td><br><br><br></td>
                </tr>


                <tr>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">วันที่</td>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">จำนวนเงินรวม</td>

                </tr>

                <?php
                $sql = "select t_date,sum(total) as 'sum'  from treatment_drug group by DATE_FORMAT(t_date, '%d %c %Y')";
                $result = mysqli_query($conn,$sql) or die(mysql_error());
                $chart2 = "data: [";

                while (list($date, $total) = mysqli_fetch_array($result)) {
                    $tim = explode(" ", $date);
                    $i = 0;
                    $ex = explode("-", $tim[0]);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    $d1 = $ex[2];


                    if ($m1 == $month and $y1 == $year) {
                        $datetest1[] = $date;

                        $dismonth[] = $total;
                        $chart2 .= $total;
                        $chart2 .= ",";




                    }

                    $i++;

                }
                $chart2 .= "]";
                $totaldis = 0;
                $countnew = count($dismonth);




                $chart1 = "labels: [";

                for ($i = 0; $i < $countnew; $i++) {


                    ?>
                    <tr style="text-align: center">
                        <?php

                        $tim = explode(" ", $datetest1[$i]);
                        $ex = explode("-", $tim[0]);
                        $y1 = $ex[0];
                        $m1 = $ex[1];
                        $d1 = $ex[2];


                        $result = $d1."/".$m1."/".$y1;

                         $chart1 .= "\"$result\"";



                        if ($i != $countnew - 1) {
                            $chart1 .= ",";
                        } else {
                            $chart1 .= "],";
                        }


                        if ($m1 == 1) {
                            $nameThai = "มกราคม";
                        } elseif ($m1 == 2) {
                            $nameThai = "กุมภาพันธ์";
                        } elseif ($m1 == 3) {
                            $nameThai = "มีนาคม";
                        } elseif ($m1 == 4) {
                            $nameThai = "เมษายน";
                        } elseif ($m1 == 5) {
                            $nameThai = "พฤษภาคม";
                        } elseif ($m1 == 6) {
                            $nameThai = "มิถุนายน";
                        } elseif ($m1 == 7) {
                            $nameThai = "กรกฎาคม";
                        } elseif ($m1 == 8) {
                            $nameThai = "สิงหาคม";
                        } elseif ($m1 == 9) {
                            $nameThai = "กันยายน";
                        } elseif ($m1 == 10) {
                            $nameThai = "ตุลาคม";
                        } elseif ($m1 == 11) {
                            $nameThai = "พฤศจิกายน";
                        } elseif ($m1 == 12) {
                            $nameThai = "ธันวาคม";
                        } else {
                            $nameThai = "";
                        }

                        $newdate = $d1 . " " . $nameThai . " " . $y1;




                        $totaldis += $dismonth[$i];
                        echo " <td style=\"border:solid 1px;padding: 5px;\"> $newdate </td>";
                        echo " <td style=\"border:solid 1px;padding: 5px;text-align: right;\">$dismonth[$i] </td>";


                        ?>

                    </tr>


                    <?php

                }


                ?>
                <tr style="text-align: center">
                    <td colspan="" style="border:solid 1px;padding: 5px;">รวมทั้งหมด</td>
                    <td style="border:solid 1px;padding: 5px;text-align: right;"> <?php echo number_format($totaldis, 2) . " บาท"; ?></td>
                </tr>

                <tr style="text-align: center; font-size: 14px;font-weight:bold;">
                    <td colspan="6"
                        style="border:solid 1px;padding: 5px;"> <?php echo "(" . convert(number_format($totaldis, 2)) . ")"; ?></td>
                </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <?php








        ?>


    </div>


    <div class="wrapper wrapper-content  ">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>กราฟรายการขายยาประจำเดือน
                            <small>รวมการขายยาแบบรายวัน</small>
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="barChart" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php } elseif (!empty($_GET['select1']) and $_GET['select1'] == "Year" and !empty($_GET['select2']) and $_GET['select2'] != "all") {
    ?>


    <div class="ibox-title">
        <h5>รายงานขายยาประจำปี</h5>

    </div>

    <div class="ibox-content" id="divprint">

        <div class="table-responsive">
            <table style="text-align: center" align="center">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="6" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="6">โทร. 053-242-417</td>
                </tr>
                <tbody>

                <?php
                if (!empty($_GET['select1'])) {
                    $tomonth = $_GET['select1'];
                } else {
                    $tomonth = "";
                }
                if (!empty($_GET['select3'])) {

                    $month = $_GET['select3'];
                } else {
                    $month = "";
                }
                if (!empty($_GET['select2'])) {
                    $year = $_GET['select2'];
                } else {
                    $year = "";
                }
                $sumdis = "";

                $sql = mysqli_query($conn,"SELECT  treat_drug_id,d_id,total,t_date FROM treatment_drug ORDER BY t_date ASC ");

                $Monthchart = "";
                $sumser_total = 0;


                for ($i = 0; $i <= 12; $i++) {

                    if ($month == $monthnum[$i]) {

                        $monthnameth = $nameth[$i];
                    }

                }
                ?>


                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">รายงานการขายยา
                        ประจำปี<?php echo " ". $year; ?></td>
                </tr>


                <tr>
                    <td><br><br><br></td>
                </tr>


                <tr>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">วันที่</td>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">จำนวนเงินรวม</td>

                </tr>

                <?php
                $sql = "select t_date,sum(total) as 'sum'  from treatment_drug group by DATE_FORMAT(t_date, '%c %Y')";
                $result = mysqli_query($conn,$sql) or die(mysql_error());
                $chart2 = "data: [";

                while (list($date, $total) = mysqli_fetch_array($result)) {
                    $tim = explode(" ", $date);
                    $i = 0;
                    $ex = explode("-", $tim[0]);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    $d1 = $ex[2];


                    if ( $y1 == $year) {
                        $datetest1[] = $date;

                        $dismonth[] = $total;
                        $chart2 .= $total;
                        $chart2 .= ",";




                    }

                    $i++;

                }
                $chart2 .= "]";
                $totaldis = 0;
                $countnew = count($dismonth);




                $chart1 = "labels: [";

                for ($i = 0; $i < $countnew; $i++) {


                    ?>
                    <tr style="text-align: center">
                        <?php

                        $tim = explode(" ", $datetest1[$i]);
                        $ex = explode("-", $tim[0]);
                        $y1 = $ex[0];
                        $m1 = $ex[1];
                        $d1 = $ex[2];


                        $result = $m1."/".$y1;

                        $chart1 .= "\"$result\"";



                        if ($i != $countnew - 1) {
                            $chart1 .= ",";
                        } else {
                            $chart1 .= "],";
                        }


                        if ($m1 == 1) {
                            $nameThai = "มกราคม";
                        } elseif ($m1 == 2) {
                            $nameThai = "กุมภาพันธ์";
                        } elseif ($m1 == 3) {
                            $nameThai = "มีนาคม";
                        } elseif ($m1 == 4) {
                            $nameThai = "เมษายน";
                        } elseif ($m1 == 5) {
                            $nameThai = "พฤษภาคม";
                        } elseif ($m1 == 6) {
                            $nameThai = "มิถุนายน";
                        } elseif ($m1 == 7) {
                            $nameThai = "กรกฎาคม";
                        } elseif ($m1 == 8) {
                            $nameThai = "สิงหาคม";
                        } elseif ($m1 == 9) {
                            $nameThai = "กันยายน";
                        } elseif ($m1 == 10) {
                            $nameThai = "ตุลาคม";
                        } elseif ($m1 == 11) {
                            $nameThai = "พฤศจิกายน";
                        } elseif ($m1 == 12) {
                            $nameThai = "ธันวาคม";
                        } else {
                            $nameThai = "";
                        }

                        $newdate =  $nameThai . " " . $y1;




                        $totaldis += $dismonth[$i];
                        echo " <td style=\"border:solid 1px;padding: 5px;\"> $newdate </td>";
                        echo " <td style=\"border:solid 1px;padding: 5px;text-align: right;\">$dismonth[$i] </td>";


                        ?>

                    </tr>


                    <?php

                }


                ?>
                <tr style="text-align: center">
                    <td colspan="" style="border:solid 1px;padding: 5px;">รวมทั้งหมด</td>
                    <td style="border:solid 1px;padding: 5px;text-align: right;"> <?php echo number_format($totaldis, 2) . " บาท"; ?></td>
                </tr>

                <tr style="text-align: center; font-size: 14px;font-weight:bold;">
                    <td colspan="6"
                        style="border:solid 1px;padding: 5px;"> <?php echo "(" . convert(number_format($totaldis, 2)) . ")"; ?></td>
                </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <?php








        ?>


    </div>
    <div class="wrapper wrapper-content  ">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>กราฟรายการขายยาประจำปี
                            <small>รวมการขายยาแบบรายเดือน</small>
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="barChart" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php } else if (!empty($_GET['select1']) and $_GET['select1'] == "Year" and !empty($_GET['select2']) == "all") {

    ?>


    <div class="ibox-title">
        <h5>รายงานการขายยาประจำปี</h5>

    </div>

    <div class="ibox-content" id="divprint">

        <div class="table-responsive">
            <table style="text-align: center" align="center">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="6" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="6">โทร. 053-242-417</td>
                </tr>
                <tbody>

                <?php
                if (!empty($_GET['select1'])) {
                    $tomonth = $_GET['select1'];
                } else {
                    $tomonth = "";
                }
                if (!empty($_GET['select3'])) {

                    $month = $_GET['select3'];
                } else {
                    $month = "";
                }
                if (!empty($_GET['select2'])) {
                    $year = $_GET['select2'];
                } else {
                    $year = "";
                }
                $sumdis = "";

                $sql = mysqli_query($conn,"SELECT  treat_drug_id,d_id,total,t_date FROM treatment_drug ORDER BY t_date ASC ");

                $Monthchart = "";
                $sumser_total = 0;


                for ($i = 0; $i <= 12; $i++) {

                    if ($month == $monthnum[$i]) {

                        $monthnameth = $nameth[$i];
                    }

                }
                ?>


                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">รายงานการขายยา
                        ทุกปี</td>
                </tr>


                <tr>
                    <td><br><br><br></td>
                </tr>


                <tr>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">วันที่</td>
                    <td style="border:solid 1px;padding: 5px; font-weight:bold;">จำนวนเงินรวม</td>

                </tr>

                <?php
                $sql = "select t_date,sum(total) as 'sum'  from treatment_drug group by DATE_FORMAT(t_date, '%Y')";
                $result = mysqli_query($conn,$sql) or die(mysql_error());
                $chart2 = "data: [";

                while (list($date, $total) = mysqli_fetch_array($result)) {
                    $tim = explode(" ", $date);
                    $i = 0;
                    $ex = explode("-", $tim[0]);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    $d1 = $ex[2];


                         $datetest1[] = $date;

                        $dismonth[] = $total;
                        $chart2 .= $total;
                        $chart2 .= ",";






                    $i++;

                }
                $chart2 .= "]";
                $totaldis = 0;
                $countnew = count($dismonth);




                $chart1 = "labels: [";

                for ($i = 0; $i < $countnew; $i++) {


                    ?>
                    <tr style="text-align: center">
                        <?php

                        $tim = explode(" ", $datetest1[$i]);
                        $ex = explode("-", $tim[0]);
                        $y1 = $ex[0];
                        $m1 = $ex[1];
                        $d1 = $ex[2];


                        $result =$y1;

                        $chart1 .= "\"$result\"";



                        if ($i != $countnew - 1) {
                            $chart1 .= ",";
                        } else {
                            $chart1 .= "],";
                        }



                        $newdate =  $y1;




                        $totaldis += $dismonth[$i];
                        echo " <td style=\"border:solid 1px;padding: 5px;\"> $newdate </td>";
                        echo " <td style=\"border:solid 1px;padding: 5px;text-align: right;\">$dismonth[$i] </td>";


                        ?>

                    </tr>


                    <?php

                }


                ?>
                <tr style="text-align: center">
                    <td colspan="" style="border:solid 1px;padding: 5px;">รวมทั้งหมด</td>
                    <td style="border:solid 1px;padding: 5px;text-align: right;"> <?php echo number_format($totaldis, 2) . " บาท"; ?></td>
                </tr>

                <tr style="text-align: center; font-size: 14px;font-weight:bold;">
                    <td colspan="6"
                        style="border:solid 1px;padding: 5px;"> <?php echo "(" . convert(number_format($totaldis, 2)) . ")"; ?></td>
                </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <?php








        ?>


    </div>
    <div class="wrapper wrapper-content  ">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>กราฟรายการขายยาประจำปี
                            <small>รวมการขายยาแบบรายปี</small>
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="barChart" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php

}

?>

<script type="text/javascript">


    $(function () {


        var barData = {

            <?php  echo $chart1;  ?>

            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.8)",
                    highlightFill: "rgba(26,179,148,0.75)",
                    highlightStroke: "rgba(26,179,148,1)",

                    <?php echo $chart2; ?>
                }
            ]
        };

        var barOptions = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 5,
            barDatasetSpacing: 1,
            responsive: true
        }


        var ctx = document.getElementById("barChart").getContext("2d");
        var myNewChart = new Chart(ctx).Bar(barData, barOptions);


    });


    function myFunction() {
        var x = document.getElementById("mySelect").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=report_dispensation&active=active21&select1=" + x;

    }


    function myFunction2() {
        var y = document.getElementById("mySelect").value;
        var x = document.getElementById("mySelect2").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=report_dispensation&active=active21&select1=" + y + "&select2=" + x;

    }

    function myFunction3() {
        var y = document.getElementById("mySelect").value;
        var x = document.getElementById("mySelect2").value;
        var z = document.getElementById("mySelect3").value;

        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=report_dispensation&active=active21&select1=" + y + "&select2=" + x + "&select3=" + z;

    }

    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=report&action=report_dispensation&select1=";

    }


</script>
