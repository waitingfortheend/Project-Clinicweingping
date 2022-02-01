<?php

check_type("Employee");


?>

<div class="row">
    <div class="col-lg-15">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>เพิ่มข้อมูลการบริการ</h5>


            </div>
            <div class="ibox-content">


                <center>
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=service&action=service_pet_manage&active=active12'>
                        เพิ่มข้อมูลการบริการ
                    </button>
                </center>
                <br>

                <?php

                if (empty($total_price)) {
                    $total_price = "";

                }

                echo "<form role='form' id='form1'  method='post'  action='index.php?module=service&action=ser_recalculate&active=active12'>";


                $total_price = 0;

                if (empty($_SESSION['spet_id'])) {
                    echo "<p align='center'>ยังไม่มีการบริการ</p>";

                } else {

                    $cnt = count($_SESSION['spet_id']);

                    $chk_del = '';
                    if (empty($_GET['chk_del'])) {
                        $chk = '';

                        $val = 1;
                        $color = 'white';

                    } else {
                        $chk = 'checked';//ให้ติ๊ก checkbox
                        $val = '';//กำหนดค่าที่ส่งจากตัวแปร $_GET['chk_del']
                        $color = '#D5EAFF';

                    }


                    if ($cnt > 0) {
                        echo "<div class='table-responsive'>";
                        echo "<table class='footable table table-stripped toggle-arrow-tiny' data-page-size='15' data-filter=#filter>";
                        echo "<thead><tr><th>ลบ</th><th>รหัสสัตว์</th><th>ชื่อสัตว์</th><th>รายละเอียด</th><th>ราคา</th></tr></thead>";
                        echo "<tbody>";
                        for ($i = 0; $i < $cnt; $i++) {


                            echo "<tr class='gradeU'>
      <td>
      <div class='i-checks'>

      <input  $chk   type='checkbox' name='cancel_id[]' value=", $_SESSION['spet_id'][$i], ">

      </div>
      </td>";

                            echo "<td>";
                            echo $_SESSION['spet_id'][$i], "</td><td>";
                            echo $_SESSION['spet_name'][$i], "</td>";


                            if (empty($_SESSION['sdetail'][$i])) {
                                $_SESSION['sdetail'][$i] = "";

                            }
                            if (empty($_SESSION['price'][$i])) {
                                $_SESSION['price'][$i] = "";

                            }

                            /*echo "<td><select data-placeholder='",$_SESSION['sdetail'][$i],"' name='detail[]' class='chosen-select' multiple style='width:300px;'' tabindex='4'>
                            <option value=",$_SESSION['sdetail'][$i],">",$_SESSION['sdetail'][$i],"</option>
                            <option value='อาบน้ำ'>อาบน้ำ</option>
                            <option value='ตัดขน'>ตัดขน</option></select></td>";
                            */

                            echo "<td><textarea name='detail[]' placeholder=\" รายละเอียด \"   onKeyPress=\"checktext2()\" size='20' >" . $_SESSION['sdetail'][$i] . "</textarea></td>";


                            echo "<td><input type='text'  placeholder=\" ราคา\"  onKeyPress=\"CheckNum()\" name='price[]'  size='10' value=", $_SESSION['price'][$i], "></td>";

                            $sum_price = $_SESSION['price'][$i];

                            $total_price += $sum_price;

                        }

                        echo "<tr>
      <td> <button class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=service&action=show_service&active=active12&chk_del=$val'><i class='fa fa-times'></i>
      </button></td>
      <td colspan=3 style='text-align:right;font-weight:bold';>รวมทั้งหมด</td>

      <td style='text-align:center;font-weight:bold';>";
                        printf("%.2f", $total_price);
                        echo "</td></tr>";

                        echo "</tbody>";
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<td colspan='6'>";
                        echo "<ul class='pagination pull-right'></ul>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<input type='hidden' name='total_price' value='$total_price'";


                        echo "</tfoot>";

                        echo "</table>";


                        echo "<input type='submit' class='btn btn-w-m btn-warning' name='button' value='คำนวณใหม่'> ";
                        echo "<input type='submit' class='btn btn-w-m btn-info' name='button' onclick='return confirm(\"ยืนยันการบริการ  ?\")' value='ยืนยันการบริการ'>";

                        echo "</form>";

                    } else {

                        echo "<p align='center'>ยังไม่มีการบริการ</p>";
                    }

                }


                ?>
            </div>
        </div>
    </div>
</div>
<script language="javascript">




$(document).ready(function () {

    $("#form1").validate({


        rules: {
            'detail[]': {
                required: true,
                ruleSD: "^[^'\"]+$"

            },
            'price[]': {
                required: true,
                number: true,
                range: [1,1000000],
            }
        },
        messages: {
            'price[]': {
                number: "กรุณากรอกตัวเลข",
                required: "กรุณากรอกจำนวนเงิน",
                range: "กรุณากรอกราคาให้ถูกต้อง",

            },'detail[]': {

                required: "กรุณากรอกรายละเอียด",
                ruleSD: "   งดใช้อักษระ single qoute หรือ double qoute"

            }


        }

    });

});


</script>