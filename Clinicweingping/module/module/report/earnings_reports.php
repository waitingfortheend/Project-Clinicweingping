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


$sumtreat_total = 0;
$sumser_total = 0;
$sumdrug_total = 0;
$chartN2 = "";
$chartN1 = "";
$chartN3 = "";
$chartN4 = "";
$chky = "";
$chkallyear = "";
$chart1 = "";
$chart2 = "";

?>


<div class="ibox-title">

    <h5>รายงานรายรับ</h5>
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

                                $sql_selectMonthser = mysqli_query($conn,"Select ser_date from service");
                                $sql_selectMonthtreat = mysqli_query($conn,"Select treat_date from treatment");
                                $sql_selectMonthdrug = mysqli_query($conn,"Select t_date from treatment_drug");


                                while (list($dateMS) = mysqli_fetch_array($sql_selectMonthser)) {

                                    $ex = explode("-", $dateMS);
                                    $y1[] = $ex[0];
                                }

                                while (list($dateTr) = mysqli_fetch_array($sql_selectMonthtreat)) {
                                    $ex2 = explode("-", $dateTr);
                                    $y2[] = $ex2[0];
                                }
                                while (list($datedr) = mysqli_fetch_array($sql_selectMonthdrug)) {
                                    $ex3 = explode("-", $datedr);
                                    $y3[] = $ex3[0];


                                }


                                $aYear = array_merge($y1, $y2, $y3);

                                $nYear1 = array_unique($aYear);

                                sort($nYear1);


                                $countYear1 = count($nYear1);
                                ?>

                                <label class="font-noraml">&nbsp; ปี&nbsp;</label>
                                <select data-placeholder="Choose a Year" class="chosen-select"
                                        style="width:200px;" name="select1_2"
                                        tabindex="2" id="mySelect2" onchange="myFunction2()">
                                    <option value="">กรุณาเลือกปี</option>

                                    <?php for ($i = 0; $i < $countYear1; $i++) {

                                        if ($_GET['select1_2'] == $nYear1[$i]) {
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

                                if (!empty($_GET['select1_2'])) {
                                    $year = $_GET['select1_2'];

                                    $sqlMonthser = mysqli_query($conn,"Select ser_date from service where ser_date LIKE '$year%'");
                                    $sqlMonthtre = mysqli_query($conn,"Select treat_date from treatment where treat_date LIKE '$year%'");
                                    $sqlMonthdru = mysqli_query($conn,"Select t_date from treatment_drug where t_date LIKE '$year%'");


                                    if (!empty($sqlMonthser)) {


                                        while (list($dateMS) = mysqli_fetch_array($sqlMonthser)) {
                                            $ex = explode("-", $dateMS);
                                            $y1[] = $ex[0];
                                            $m1[] = $ex[1];


                                        }
                                    } else {
                                        $m1[] = array();

                                    }

                                    if (!empty($sqlMonthtre)) {


                                        while (list($TRE) = mysqli_fetch_array($sqlMonthtre)) {
                                            $ex = explode("-", $TRE);
                                            $y2[] = $ex[0];
                                            $m2[] = $ex[1];
                                        }

                                    } else {
                                        $m2[] = array();

                                    }

                                    if (!empty($sqlMonthdru)) {


                                        while (list($dru) = mysqli_fetch_array($sqlMonthdru)) {
                                            $ex = explode("-", $dru);
                                            $y3[] = $ex[0];
                                            $m3[] = $ex[1];


                                        }

                                    } else {
                                        $m3[] = array();

                                    }

                                    if (empty($m1)) {
                                        $m1[0] = 0;
                                    }

                                    if (empty($m2)) {
                                        $m2[0] = 0;
                                    }

                                    if (empty($m3)) {
                                        $m3[0] = 0;
                                    }


                                    $allMonth = array_merge($m1, $m2, $m3);
                                    $arr_results = array_filter($allMonth);
                                    $nmmonth1 = array_unique($arr_results);
                                    sort($nmmonth1);


                                    $monthnameth = array();


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

                                    ?>


                                    <?php


                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-success \" onClick=printDiv(\"divprint\")><i class=\"fa fa-upload\"></i> |<span
                    class=\"bold\">Print</span></button>";

                                }


                            } elseif ($select1 == 2) {


                                $sql_selectMonthser = mysqli_query($conn,"Select ser_date from service");
                                $sql_selectMonthtreat = mysqli_query($conn,"Select treat_date from treatment");
                                $sql_selectMonthdrug = mysqli_query($conn,"Select t_date from treatment_drug");


                                while (list($dateMS) = mysqli_fetch_array($sql_selectMonthser)) {
                                    $ex = explode("-", $dateMS);
                                    $y1[] = $ex[0];
                                }
                                while (list($dateTr) = mysqli_fetch_array($sql_selectMonthtreat)) {

                                    $ex2 = explode("-", $dateTr);
                                    $y2[] = $ex2[0];

                                }
                                while (list($datedr) = mysqli_fetch_array($sql_selectMonthdrug)) {

                                    $ex3 = explode("-", $datedr);
                                    $y3[] = $ex3[0];
                                }

                                $aYear = array_merge($y1, $y2, $y3);

                                $nYear1 = array_unique($aYear);

                                sort($nYear1);


                                $countYear1 = count($nYear1);
                                ?>

                                <label class="font-noraml">&nbsp; ปี&nbsp;</label>
                                <select data-placeholder="Choose a Type" class="chosen-select"
                                        style="width:200px;" name="select1_2"
                                        tabindex="2" id="mySelect2" onchange="myFunction2()">
                                    <option value="">กรุณาเลือกปี</option>

                                    <?php for ($i = 0; $i < $countYear1; $i++) {

                                        if ($_GET['select1_2'] == $nYear1[$i]) {
                                            $chky = "selected";
                                        } elseif ($_GET['select1_2'] == "all") {
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
                                if (!empty($_GET['select1_2'])) {
                                    $year = $_GET['select1_2'];
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


<?php if (!empty($_GET['select1']) and $_GET['select1'] == "Month" and !empty($_GET['select1_2']) and !empty($_GET['select3'])) {

    $sumtreat_total = 0;
    $sumser_total = 0;
    $sumdrug_total = 0;

    ?>

    <div class="ibox-title">
        <h5>รายงานรายรับประจำเดือน</h5>

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
                    <td colspan="2" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="2">โทร. 053-242-417</td>
                </tr>


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
                if (!empty($_GET['select1_2'])) {
                    $year = $_GET['select1_2'];
                } else {
                    $year = "";
                }


                $sql = mysqli_query($conn,"SELECT  ser_date,ser_total FROM service");
                while (list($date, $ser_total) = mysqli_fetch_array($sql)) {
                    $ex = explode("-", $date);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    if ($m1 == $month and $y1 == $year) {
                        $sumser_total += $ser_total;
                    }


                }

                $sql_treatment = mysqli_query($conn,"SELECT  treat_date,cash_total FROM treatment");
                while (list($t_date, $t_total) = mysqli_fetch_array($sql_treatment)) {
                    $ex = explode("-", $t_date);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    if ($m1 == $month and $y1 == $year) {
                        $sumtreat_total += $t_total;
                    }


                }


                $sql_drug = mysqli_query($conn,"SELECT  total,t_date FROM treatment_drug");
                while (list($d_total, $d_date) = mysqli_fetch_array($sql_drug)) {
                    $ex = explode("-", $d_date);
                    $y1 = $ex[0];
                    $m1 = $ex[1];
                    if ($m1 == $month and $y1 == $year) {
                        $sumdrug_total += $d_total;
                    }


                }


                for ($i = 0; $i <= 12; $i++) {

                    if ($month == $monthnum[$i]) {

                        $monthnameth = $nameth[$i];
                    }

                }
                ?>

                <tr>
                    <td colspan="2">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 15px;">รายงานรายรับ
                        ประจำเดือน <?php echo $monthnameth . " " . $year; ?></td>
                </tr>
                <tr>
                    <td><br><br><br></td>
                </tr>

                <tr style="text-align: left">
                    <td>ค่ารักษา</td>
                    <td style="text-align: right"> <?php echo number_format($sumtreat_total, 2) . " บาท"; ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr style="text-align: left">
                    <td>การขาย</td>
                    <td style="text-align: right"> <?php echo number_format($sumdrug_total, 2) . " บาท"; ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr style="text-align: left">
                    <td>ค่าบริการอาบน้ำตัดขน</td>
                    <td style="text-align: right"> <?php echo number_format($sumser_total, 2) . " บาท"; ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>

                <?php $sumall = $sumser_total + $sumtreat_total + $sumdrug_total; ?>

                <tr style="text-align: center">
                    <td>รวมทั้งหมด</td>
                    <td> <?php echo number_format($sumall, 2) . " บาท"; ?></td>
                </tr>


                <tr style="text-align: right; font-size: 14px;font-weight:bold; ">
                    <td> <?php echo "(" . convert(number_format($sumall, 2)) . ")"; ?></td>
                </tr>


                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>

    <?php


    $chartN1 = "";
    if ($sumtreat_total != 0) {
        $chartN1 .= "{label: \"ค่ารักษา\",
            data: $sumtreat_total,
            color: \"#79d2c0\",
            },";
    } else {
        $chartN1 .= "";
    }
    if ($sumdrug_total != 0) {
        $chartN1 .= "{label: \"การขาย\",
            data: $sumdrug_total,
            color: \"#69a2c0\",
        },";
    } else {
        $chartN1 .= "";
    }
    if ($sumser_total != 0) {
        $chartN1 .= "{label: \"ค่าบริการ\",
            data: $sumser_total,
            color: \"#1ab394\",
        }";
    } else {
        $chartN1 .= "";
    }


    $chartN2 = "";

    if ($sumtreat_total != 0) {
        $chartN2 .= "{ y: 'การรักษา', a: $sumtreat_total },";
    } else {
        $chartN2 .= "";
    }
    if ($sumdrug_total != 0) {
        $chartN2 .= "{ y: 'การขาย', a: $sumdrug_total },";
    } else {
        $chartN2 .= "";
    }
    if ($sumser_total != 0) {
        $chartN2 .= "{ y: 'ค่าบริการ', a: $sumser_total }";
    } else {
        $chartN2 .= "";
    }


    ?>
    <br>
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>แผนภูมิวงกลม รายงานรายรับ</h5>
                   
                </div>
                <div class="ibox-content">
                    <div class="flot-chart">
                        <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
                    </div>
                </div>


            </div>

        </div>

        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>แผนภูมิแท่ง รายงานรายรับ</h5>
                    <div  class="ibox-tools">
                      



                    </div>
                </div>
                <div class="ibox-content">
                    <div class="ibox-content">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
                <?php
                $chart2 = "data: [1]";
                $chart1 = "labels: [1],";

                ?>
                <div hidden>
                    <canvas id="barChart" height="140"></canvas>
                </div>


            </div>

        </div>


    </div>


<?php } elseif (!empty($_GET['select1']) and $_GET['select1'] == "Year" and !empty($_GET['select1_2']) and $_GET['select1_2'] != "all") {

    $sumtreat_total = 0;
    $sumser_total = 0;
    $sumdrug_total = 0;

    ?>


    <div class="ibox-title">
        <h5>รายงานรายรับประจำปี</h5>

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
                    <td colspan="2" style="font-size: 18px;">คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 15px;">133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="2">โทร. 053-242-417</td>
                </tr>


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
                if (!empty($_GET['select1_2'])) {
                    $year = $_GET['select1_2'];
                } else {
                    $year = "";
                }
                $sumtreat_total = 0;
                $sumser_total = 0;
                $sumdrug_total = 0;


                $sql = mysqli_query($conn,"SELECT  ser_date,ser_total FROM service");
                while (list($date, $ser_total) = mysqli_fetch_array($sql)) {
                    $ex = explode("-", $date);
                    $y1 = $ex[0];
                    if ($y1 == $year) {
                        $sumser_total += $ser_total;
                    }


                }

                $sql_treatment = mysqli_query($conn,"SELECT  treat_date,cash_total FROM treatment");
                while (list($t_date, $t_total) = mysqli_fetch_array($sql_treatment)) {
                    $ex = explode("-", $t_date);
                    $y1 = $ex[0];
                    if ($y1 == $year) {
                        $sumtreat_total += $t_total;
                    }


                }


                $sql_drug = mysqli_query($conn,"SELECT  total,t_date FROM treatment_drug");
                while (list($d_total, $d_date) = mysqli_fetch_array($sql_drug)) {
                    $ex = explode("-", $d_date);
                    $y1 = $ex[0];
                    if ($y1 == $year) {
                        $sumdrug_total += $d_total;
                    }


                }


                ?>

                <tr>
                    <td colspan="2">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 15px;">รายงานรายรับ
                        ประจำปี <?php echo $year; ?></td>
                </tr>
                <tr>
                    <td><br><br><br></td>
                </tr>


                <tr style="text-align: left">
                    <td>ค่ารักษา</td>
                    <td style="text-align: right"> <?php echo number_format($sumtreat_total, 2) . " บาท"; ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr style="text-align: left">
                    <td>การขาย</td>
                    <td style="text-align: right"> <?php echo number_format($sumdrug_total, 2) . " บาท"; ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr style="text-align: left">
                    <td>ค่าบริการอาบน้ำตัดขน</td>
                    <td style="text-align: right"> <?php echo number_format($sumser_total, 2) . " บาท"; ?></td>
                </tr>

                <tr>
                    <td><br></td>
                </tr>

                <?php $sumall = $sumser_total + $sumtreat_total + $sumdrug_total; ?>

                <tr style="text-align: center">
                    <td>รวมทั้งหมด</td>
                    <td> <?php echo number_format($sumall, 2) . " บาท"; ?></td>
                </tr>


                <tr style="text-align: right; font-size: 14px;font-weight:bold; ">
                    <td> <?php echo "(" . convert(number_format($sumall, 2)) . ")"; ?></td>
                </tr>


                </tbody>
                <tfoot>


                </tfoot>
            </table>

        </div>

    </div>

    <?php


    $chartN1 = "";
    if ($sumtreat_total != 0) {
        $chartN1 .= "{label: \"ค่ารักษา\",
            data: $sumtreat_total,
            color: \"#79d2c0\",
            },";
    } else {
        $chartN1 .= "";
    }
    if ($sumdrug_total != 0) {
        $chartN1 .= "{label: \"การขาย\",
            data: $sumdrug_total,
            color: \"#69a2c0\",
        },";
    } else {
        $chartN1 .= "";
    }
    if ($sumser_total != 0) {
        $chartN1 .= "{label: \"ค่าบริการ\",
            data: $sumser_total,
            color: \"#1ab394\",
        }";
    } else {
        $chartN1 .= "";
    }


    $chartN2 = "";

    if ($sumtreat_total != 0) {
        $chartN2 .= "{ y: 'การรักษา', a: $sumtreat_total },";
    } else {
        $chartN2 .= "";
    }
    if ($sumdrug_total != 0) {
        $chartN2 .= "{ y: 'การขาย', a: $sumdrug_total },";
    } else {
        $chartN2 .= "";
    }
    if ($sumser_total != 0) {
        $chartN2 .= "{ y: 'ค่าบริการ', a: $sumser_total }";
    } else {
        $chartN2 .= "";
    }


    ?>
    <br>

    <div class="row">
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>แผนภูมิวงกลม รายงานรายจ่าย</h5>

                </div>
                <div class="ibox-content">
                    <div class="flot-chart">
                        <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
                    </div>
                </div>


            </div>

        </div>


        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>แผนภูมิแท่ง รายจ่าย</h5>
                   
                </div>
                <div class="ibox-content">
                    <div class="ibox-content">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>


            </div>


            <?php
            $chart2 = "data: [1]";
            $chart1 = "labels: [1],";

            ?>
            <div hidden>
                <canvas id="barChart" height="140"></canvas>
            </div>

        </div>


    </div>


<?php } else if (!empty($_GET['select1']) and $_GET['select1'] == "Year" and !empty($_GET['select1_2']) == "all") {
    ?>


    <div class="ibox-title">
        <h5> รายงานรับประจำปี</h5>

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
                    <td colspan="6" style="font-size: 18px;"> คลินิคเวียงพิงค์รักษาสัตว์</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;"> 133 หมู่ 2 ตำบลฟ้าฮ้าม อำเภอเมือง จังหวัดเชียงใหม่</td>
                </tr>
                <tr>
                    <td colspan="6"> โทร . 053 - 242 - 417</td>
                </tr>


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
                if (!empty($_GET['select1_2'])) {
                    $year = $_GET['select1_2'];
                } else {
                    $year = "";
                }


                $sql = mysqli_query($conn,"SELECT  ser_date,sum(ser_total) as 'sum' FROM service group by DATE_FORMAT(ser_date, '%Y') ");
                while (list($date, $ser_total) = mysqli_fetch_array($sql)) {
                    $sum_ser_total[] = $ser_total;
                    $ex = explode("-", $date);
                    $y1[] = $ex[0];

                }

                $sql_treatment = mysqli_query($conn,"SELECT  treat_date,sum(cash_total) as 'sum' FROM treatment  group by DATE_FORMAT(treat_date, '%Y')");
                while (list($t_date, $t_total) = mysqli_fetch_array($sql_treatment)) {

                    $sum_treat_total[] = $t_total;

                    $ex = explode("-", $t_date);
                    $y2[] = $ex[0];
                }


                $sql_drug = mysqli_query($conn,"SELECT  t_date,sum(total) as ' sum' FROM treatment_drug group by DATE_FORMAT(t_date, '%Y')");
                while (list($d_date, $d_total) = mysqli_fetch_array($sql_drug)) {

                    $sum_drug_total[] = $d_total;
                    $ex = explode("-", $d_date);
                    $y3[] = $ex[0];

                }


                $n1 = array_unique($y1);
                $n2 = array_unique($y2);
                $n3 = array_unique($y3);

                $result = array_merge($n1, $n2, $n3);

                $allyear = array_unique($result);
                $yearall = array_filter($allyear);

                $countallyear = count($yearall);

                sort($yearall);


                ?>

                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 15px;">รายงานรายรับ
                        ทุกปี
                    </td>
                </tr>
                <tr>
                    <td><br><br><br></td>
                </tr>


                <tr>
                    <td style="border:solid 1px;padding: 5px;">ประจำปี</td>

                    <td style="border:solid 1px;padding: 5px;">รวมรายรับประจำปี</td>

                </tr>


                <?php

                $count_ser = count($sum_ser_total);
                $count_tre = count($sum_treat_total);
                $count_drug = count($sum_drug_total);


                for ($i = 0; $i < $countallyear; $i++) {

                    $sumall[$i] = 0;

                }


                for ($i = 0; $i < $count_ser; $i++) {
                    if (!empty($sum_ser_total[$i])) {
                        $sumall[$i] += $sum_ser_total[$i];

                    }

                }

                for ($i = 0; $i < $count_tre; $i++) {
                    if (!empty($sum_treat_total[$i])) {

                        $sumall[$i] += $sum_treat_total[$i];
                    }
                }
                for ($i = 0; $i < $count_drug; $i++) {
                    if (!empty($sum_drug_total[$i])) {


                        $sumall[$i] += $sum_drug_total[$i];
                    }
                }


                ?>

                <?php
                for ($i = 0; $i < $countallyear; $i++) {


                    ?>

                    <tr>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $yearall[$i] ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $sumall[$i] ?></td>

                    </tr>

                    <?php

                }


                $countsumyear = count($sumall);
                $chart2 = "data: [";
                for ($i = 0; $i < $countsumyear; $i++) {

                    $chart2 .= $sumall[$i];

                    $chart2 .= ",";


                }
                $chart2 .= "]";


                $chart1 = "labels: [";

                for ($i = 0; $i < $countallyear; $i++) {


                    $chart1 .= "\"$yearall[$i]\"";

                    if ($i != $countallyear - 1) {
                        $chart1 .= ",";
                    } else {
                        $chart1 .= "],";
                    }


                }


                ?>

                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>

    <?php


    $chartN1 = "";
    $chartN1 .= "{label: \" \",
            data: 0,
            color: \"#79d2c0\",
            },";

    $chartN2 = "";

    $chartN2 .= "{ y: '', a: 0 }";


    ?>

    <div class="wrapper wrapper-content  ">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>กราฟรายจ่ายประปี
                            <small>รวมรายจ่ายแบบรายปี</small>
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

    <div hidden class="flot-chart-pie-content" id="flot-pie-chart"></div>

    <div hidden id="morris-bar-chart"></div>


    <?php
}


?>


<script type="text/javascript">


    //Flot Pie Chart
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


        Morris.Bar({
            element: 'morris-bar-chart',
            data: [

                <?php   echo $chartN2;  ?>

            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['รวม'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#1ab394', '#cacaca'],
        });


        var data = [

            <?php  echo $chartN1;  ?>

        ];

        var plotObj = $.plot($("#flot-pie-chart"), data, {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });

    });

    function myFunction() {
        var x = document.getElementById("mySelect").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=earnings_reports&active=active18&select1=" + x;

    }

    function myFunction2() {
        var y = document.getElementById("mySelect").value;
        var x = document.getElementById("mySelect2").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=earnings_reports&active=active18&select1=" + y + "&select1_2=" + x;

    }
    function myFunction3() {
        var y = document.getElementById("mySelect").value;
        var x = document.getElementById("mySelect2").value;
        var z = document.getElementById("mySelect3").value;

        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=earnings_reports&active=active18&select1=" + y + "&select1_2=" + x + "&select3=" + z;

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
        window.location.href = "index.php?module=report&action=earnings_reports&select1=";

    }
</script>
