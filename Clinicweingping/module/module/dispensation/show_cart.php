<?php
if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
?>

<div class="row">
    <div class="col-lg-15">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>เพิ่มข้อมูลการขายยา</h5>


            </div>
            <div class="ibox-content">


                <center>
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=dispensation&action=dispensation_drug_manage&active=active16'>
                        เพิ่มข้อมูลการขาย
                    </button>
                </center>
                <br>

                <?php

                if (empty($total_price)) {
                    $total_price = "";

                }

                echo "<form method='post' role='form' id='form1' action='index.php?module=dispensation&action=recalculate'>";


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
                        echo "     <input type=\"text\" class=\"form-control input-sm m-b-xs\" id=\"filter\"
                                   placeholder=\"Search in table\">";
                        echo "<table class='footable table table-stripped toggle-arrow-tiny' data-page-size='15' data-filter=#filter>";
                        echo "<thead><tr><th>ลบ</th><th>รหัสยา</th><th>ชื่อยา</th><th>คงเหลือ</th><th>ราคา</th><th>จำนวน</th><th>ราคารวม</th></tr></thead>";
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
                            echo $_SESSION['drug_name_eng'][$i], "</td><td>";
                            echo $_SESSION['all'][$i] . " " . $_SESSION['unit'][$i], "</td>";


                            echo "<td> ",$_SESSION['drug_price'][$i] ,"</td>";

                            echo "<td width='10%'>
                    
                             <input type='text' size='8'  onkeypress=\"return checknum2()\"  name='amount[]'  value=", $_SESSION['drug_amount'][$i], "></td>";


                            $sum_price = $_SESSION['drug_price'][$i] * $_SESSION['drug_amount'][$i];


                            echo "<td>";
                            printf("%.2f", $sum_price);//แสดงผมในรูปแบบ ทศนิยม
                            echo "</td></tr>";


                            $total_price += $sum_price;

                        }


                        echo "<tr>
      <td> <button class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=dispensation&action=show_cart&active=active16&chk_del=$val'><i class='fa fa-times'></i>
      </button></td>
      <td colspan=5 style='text-align:right;font-weight:bold';>รวมทั้งหมด</td>

      <td style='text-align:center;font-weight:bold';>";
                        printf("%.2f", $total_price);
                        echo "</td></tr>";

                        echo "</tbody>";
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<td colspan='7'>";
                        echo "<ul class='pagination pull-right'></ul>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<input type='hidden' name='total_price' required=''    value='$total_price'";


                        echo "</tfoot>";

                        echo "</table>";


                        echo "<input type='submit' class='btn btn-w-m btn-warning' name='button' value='คำนวณใหม่'> ";


                        echo "<input type='submit' class='btn btn-w-m btn-info' name='button' onclick='return confirm(\"ยืนยันการขายยา  ?\")' value='ยืนยันการขายยา'>";

                        echo "</form>";

                    } else {

                        echo "<p align='center'>ยังไม่มีการขายยา</p>";
                    }

                }


                ?>
            </div>


        </div>
    </div>
</div>

<script>

//    function checknum2(e){
//        var keyPressed;
//        if(window.event){ // IE
//            if (event.keyCode < 48 || event.keyCode > 57){
//                event.returnValue = false;
//            }
//        }else{
//            keyPressed = e.which; // Firefox
//            if (keyPressed != 8 && (keyPressed < 48) || (keyPressed > 57)){
//                keyPressed = e.preventDefault();
//            }
//        }
//    }




$(document).ready(function () {

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
                ruleSD: "งดใช้อักษระ single qoute หรือ double qoute",
                range: "กรุณากรอกจำนวนให้ถูกต้อง",
            }


        }

    });

});

</script>