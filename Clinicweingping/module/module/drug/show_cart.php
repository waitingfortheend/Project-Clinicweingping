<?php
check_type("Owner");
?>

<div class="row">
    <div class="col-lg-15">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>จัดการข้อมูลยา</h5>


            </div>
            <div class="ibox-content">


                <center>
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=buy&action=buy_drug_manage&active=active10'>
                        เพิ่มข้อมูลการซื้อ
                    </button>
                </center>
                <br>

                <?php

                if (empty($total_price)) {
                    $total_price = "";

                }

                echo "<form id='form1' role='form'  method='post' action='index.php?module=drug&action=recalculate'>";


                $total_price = 0;

                if (empty($_SESSION['drug_price'])) {
                    echo "<p align='center'>ยังไม่มีสินค้าที่ต้องการเพิ่ม</p>";

                } else {

                    $cnt = count($_SESSION['drug_price']);

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
                        echo "<thead><tr><th>ลบ</th><th>รหัสยา</th><th>ชื่อยา</th><th>ราคา</th><th>จำนวน</th><th>ราคารวม</th></tr></thead>";
                        echo "<tbody>";
                        for ($i = 0; $i < $cnt; $i++) {


                            echo "<tr class='gradeU'>
      <td>
      <div class='i-checks'>

      <input  $chk   type='checkbox' name='cancel_id[]' value=", $_SESSION['sdrug_id'][$i], ">

      </div>
      </td>";

                            echo "<td>";
                            echo $_SESSION['sdrug_id'][$i], "</td><td>";
                            echo $_SESSION['drug_name_eng'][$i], "</td>";

                            echo "<td>" . $_SESSION['drug_price'][$i], "</td>";


                            echo "<input type='hidden' name='price[]' size=8 value=", $_SESSION['drug_price'][$i], ">";
                            echo "<td><input type='text'  onKeyPress=\"CheckNum()\" name='amount[]' size=8 value=", $_SESSION['drug_amount'][$i], "></td>";


                            $sum_price = $_SESSION['drug_price'][$i] * $_SESSION['drug_amount'][$i];


                            echo "<td>";
                            printf("%.2f", $sum_price);//แสดงผมในรูปแบบ ทศนิยม
                            echo "</td></tr>";


                            $total_price += $sum_price;

                        }


                        echo "<tr>
      <td> <button class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=drug&action=show_cart&active=active10&chk_del=$val'><i class='fa fa-times'></i>
      </button></td>
      <td colspan=4 style='text-align:right;font-weight:bold';>รวมทั้งหมด</td>

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
                        echo "<input type='submit' class='btn btn-w-m btn-info' name='button' onclick='return confirm(\"ยืนยันการซื้อ  ?\")' value='ยืนยันการสั่งซื้อ'>";

                        echo "</form>";

                    } else {

                        echo "<p align='center'>ยังไม่มีสินค้าที่ต้องการเพิ่ม</p>";
                    }

                }


                ?>

            </div>
        </div>
    </div>


    <script language="javascript">
        $(document).ready(function() {

        $("#form1").validate({


            rules: {
                'amount[]': {
                    required: true,
                    number: true,
                range: [1,1000000],
                }
            },
            messages: {
                'amount[]': {
                    number: "กรุณากรอกตัวเลข",
                    required: "กรุณากรอกจำนวน",
                    range: "กรุณากรอกข้อมูลให้ถูกต้อง"
                   

                }


            }

        });



        });




//        function CheckNum(){
//            if (event.keyCode < 48 || event.keyCode > 57){
//                event.returnValue = false;
//            }
//        }
    </script>

