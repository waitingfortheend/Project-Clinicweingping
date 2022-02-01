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


?>


<div class="ibox-title">

    <h5>รายงานยาคงเหลือ</h5>
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


                        if (!empty($_GET['select1']) and $_GET['select1'] == "All") {

                            $chk1 = "selected";
                            $select1 = 1;
                        } elseif (!empty($_GET['select1']) and $_GET['select1'] == "Type") {
                            $chk2 = "selected";
                            $select1 = 2;
                        }


                        ?>

                        <select data-placeholder="Choose a Type" class="chosen-select"
                                style="width:200px;" name="select1"
                                tabindex="2" id="mySelect" onchange="myFunction()">
                            <option value="">กรุณาเลือกประเภทรายงาน</option>
                            <option <?php echo $chk1; ?> value="All">ยาคงเหลือทั้งหมด</option>
                            <option <?php echo $chk2; ?> value="Type">ยาคงเหลือตามประเภท</option>
                        </select>


                        <?php


                        if (!empty($select1)) {


                            if ($select1 == 1) {


                                echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-success \" onClick=printDiv(\"divprint\")><i class=\"fa fa-upload\"></i> |<span
                    class=\"bold\">Print</span></button>";
                            } elseif ($select1 == 2) {


                                $sqlType = mysqli_query($conn,"Select * from type_drug ");


                                ?>


                                <label class="font-noraml">&nbsp; ประเภทยา&nbsp;</label>
                                <select data-placeholder="Choose a Type" class="chosen-select"
                                        style="width:200px;" name="select2"
                                        tabindex="2" id="mySelect2" onchange="myFunction2()">
                                    <option value="">กรุณาเลือกประเภท</option>


                                    <?php


                                    while (list($type_id, $type_d_name) = mysqli_fetch_array($sqlType)) {


                                        if ($_GET['select2'] == $type_id) {
                                            $chky = "selected";
                                        } else {
                                            $chky = "";
                                        }
                                        ?>
                                        <option <?php echo $chky; ?>
                                            value="<?php echo $type_id; ?>"><?php echo $type_d_name; ?></option>

                                        <?php

                                    }
                                    ?>
                                </select>

                                <?php
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-success \" onClick=printDiv(\"divprint\")><i class=\"fa fa-upload\"></i> |<span
                                class=\"bold\">Print</span></button>";

                            }
                        }


                        ?>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($_GET['select1']) and $_GET['select1'] == "All") {

    ?>

    <div class="ibox-title">
        <h5>รายงานยาคงเหลือทั้งหมด</h5>

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

                <?php
                if (!empty($_GET['select1'])) {
                    $all = $_GET['select1'];
                }


                ?>
                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 18px;">รายงานยาคงเหลือ</td>
                </tr>
                <?php
                $date = date("d-m-Y");
                ?>

                <tr>
                    <td colspan="6" style="font-size: 18px;">ณ วันที่  <?php echo $date; ?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                <tr>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">รหัสยา</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">ชื่อยาภาษาอังกฤษ</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">ชื่อยาภาษาไทย</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">วัน/เดือน/ปี หมดอายุ</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">จำนวน</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">หน่วยนับ</td>

                </tr>
                <?php

                $sql_drug = mysqli_query($conn,"select * from drug ORDER BY d_id ASC ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                while (list($d_id, $d_eng, $d_th, $d_detail, $d_price, $s_price, $amount, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    ?>
                    <tr>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_id; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_eng; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_th; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $exp; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $amount; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $unit; ?></td>

                    </tr>


                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


<?php } elseif (!empty($_GET['select1']) and $_GET['select1'] == "Type" and  !empty($_GET['select2'])  ) {

    ?>


    <div class="ibox-title">
        <h5>รายงานยาคงเหลือตามประเภท</h5>

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

                <?php
                if (!empty($_GET['select1'])) {
                    $all = $_GET['select1'];
                }
                $sqlType = mysqli_query($conn,"select * from type_drug WHERE type_d_id = '$_GET[select2]'") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                list($type_id,$type_name) = mysqli_fetch_array($sqlType);

                ?>
                <tr>
                    <td colspan="6">
                        <div class="hr-line-dashed"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size: 18px;">รายงานยาคงเหลือ ประเภท <?php echo $type_name; ?></td>
                </tr>
                <?php
                $date = date("d-m-Y");
                ?>

                <tr>
                    <td colspan="6" style="font-size: 18px;">ณ วันที่  <?php echo $date; ?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">รหัสยา</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">ชื่อยาภาษาอังกฤษ</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">ชื่อยาภาษาไทย</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">วัน/เดือน/ปี หมดอายุ</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">จำนวน</td>
                    <td style="border:solid 1px;padding: 5px;font-weight:bold;">หน่วยนับ</td>

                </tr>
                <?php

                $sql_drug = mysqli_query($conn,"select * from drug WHERE type_d_id = '$_GET[select2]'") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                while (list($d_id, $d_eng, $d_th, $d_detail, $d_price, $s_price, $amount, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    ?>
                    <tr>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_id; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_eng; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $d_th; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $exp; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $amount; ?></td>
                        <td style="border:solid 1px;padding: 5px;"><?php echo $unit; ?></td>

                    </tr>


                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


<?php } ?>

<script>

    function myFunction() {
        var x = document.getElementById("mySelect").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=drug_stocks&active=active20&select1=" + x;

    }

    function myFunction2() {
        var y = document.getElementById("mySelect").value;
        var x = document.getElementById("mySelect2").value;
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        window.location.href = "index.php?module=report&action=drug_stocks&active=active20&select1=" + y + "&select2=" + x;

    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=report&action=drug_stocks&select1=";

    }

</script>