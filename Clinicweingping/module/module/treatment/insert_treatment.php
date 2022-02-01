<?php

check_type("Veterinary");


?>

<?php


if (empty($_POST['drug'])) {

} else {

    $count = count($_POST['drug']);


    for ($i = 0; $i < $count; $i++) {


        if (empty($_POST['drug'][$i]) or empty($_SESSION['sdrug_id'])) {//ถ้าตระกร้าสินค้าว่าง

            $_SESSION['sdrug_id'] = array();//กำหนดให้ เป็น array
            $_SESSION['drug_name_eng'] = array();
            $_SESSION['drug_price'] = array();
            $_SESSION['all'] = array();
            $_SESSION['unit'] = array();
            $_SESSION['drug_amount'] = array();

        }

        $d_id = $_POST['drug'][$i];

        if (!in_array($_POST['drug'][$i], $_SESSION['sdrug_id'])) {//ถ้า product_id ที่ส่งมา ไม่ซ้ำใน session จะเพิ่มในอาเรย์
            $sql_drug = mysqli_query($conn,"select * from drug where d_id='$d_id' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
            list($d_id, $d_eng, $d_th, $d_detail, $d_price, $d_sprice, $a, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug);


            $_SESSION['sdrug_id'][] = $d_id;
            $_SESSION['drug_name_eng'][] = $d_eng;
            $_SESSION['drug_price'][] = $d_sprice;
            $_SESSION['all'][] = $a;
            $_SESSION['unit'][] = $unit;
            $_SESSION['drug_amount'][] = 1;

        }


    }


}
if (!empty($_POST['treat_exa'])) {

    $_SESSION['treat_exa'] = $_POST['treat_exa'];
}
if (!empty($_POST['treat_sick'])) {

    $_SESSION['treat_sick'] = $_POST['treat_sick'];
}
if (!empty($_POST['treat_judge'])) {

    $_SESSION['treat_judge'] = $_POST['treat_judge'];
}
if (!empty($_POST['treat_price'])) {

    $_SESSION['treat_price'] = $_POST['treat_price'];
}
if (!empty($_POST['p_id'])) {

    $_SESSION['p_id'] = $_POST['p_id'];
}
if (!empty($_POST['t_id'])) {

    $_SESSION['t_id'] = $_POST['t_id'];
}

if (!empty($_POST['chkapp'])) {

    $_SESSION['chkapp'] = $_POST['chkapp'];
}
if (!empty($_POST['app'])) {

    $_SESSION['app'] = $_POST['app'];
}
if (!empty($_POST['app_detail'])) {

    $_SESSION['app_detail'] = $_POST['app_detail'];
}
if (!empty($_POST['time'])) {

    $_SESSION['time'] = $_POST['time'];

}


?>




<?php


$sql_pet = mysqli_query($conn,"select * from pet where pet_id=$_SESSION[p_id]  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);

if (empty($pet_picture)) {
    $pet_picture = "no-d.jpg";

}


?>

<div class="row">
    <div class="col-lg-4">
        <div class="widget-head-color-box navy-bg  text-center">
            <div class="m-b-md">
                <br>
                <h2 class="font-bold no-margins">
                    <?php echo $pet_name ?>
                </h2>
                <small><?php echo $pet_id ?></small>
            </div>


            <img src="images/<?php echo $pet_picture ?>" class="img-circle circle-border m-b-md" width="150px"
                 alt="profile">

        </div>
        <div class="widget-text-box">

            <h4 class="media-heading">ผลตรวจร่างกาย</h4>
            <p><?php echo $_SESSION['treat_exa']; ?></p>
            <h4 class="media-heading">อาการ</h4>
            <p><?php echo $_SESSION['treat_sick']; ?></p>
            <h4 class="media-heading">ผลการวินิจฉัย</h4>
            <p><?php echo $_SESSION['treat_judge']; ?></p>


            <?php
            if (!empty($_SESSION['chkapp']) and !empty($_SESSION['app']) and !empty($_SESSION['app_detail'])) {
                echo "<h4 class='media-heading'>วันที่นัดหมาย</h4>";
                echo "<p>วันที่ $_SESSION[app] เวลา $_SESSION[time]</p>";


                echo "<h4 class='media-heading'>รายละเอียดการนัด</h4>";
                echo "<p>$_SESSION[app_detail] </p>";

            }


            ?>


                   <h4> ค่ารักษา </h4><?php echo $_SESSION['treat_price'] . " บาท"; ?></a>

        </div>
    </div>


    <!------------------------------ TREATMENT DRUG --------------->

    <br>
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>รายการขายยา</h5>

                
            </div>
            <div class="ibox-content">


                <center>
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=treatment&action=treatment_drug_manage&active=active13'>
                        เพิ่มข้อมูลยา
                    </button>
                </center>
                <br>


                <?php

                if (empty($total_price)) {
                    $total_price = "";

                }

                echo "<form id='form1' role='form' method='post'  action='index.php?module=treatment&action=treat_recalculate'>";


                $total_price = 0;

                if (empty($_SESSION['drug_price'])) {
                    echo "<p align='center'>ยังไม่มีการจ่ายยา</p>";

                    echo "<input type='submit' class='btn btn-w-m btn-danger' name='button'  onclick='return confirm(\"ต้องการยกเลิกรายการนี้  ?\")' value='ยกเลิกการทำรายการ'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";

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
                        echo "<thead><tr><th>ลบ</th><th>รหัสยา</th><th>ชื่อยา</th><th>ชื่อยา</th><th>ราคาขาย</th><th>จำนวน</th><th>ราคารวม</th></tr></thead>";
                        echo "<tbody>";
                        for ($i = 0; $i < $cnt; $i++) {


                            echo "<tr class='gradeU'>
               <td>
               <div class='i-checks'>
                        
               <input  $chk   type='checkbox' name='cancel_id[]' value=", $_SESSION['sdrug_id'][$i], ">
                        
               </div>
               </td>";


                            echo "<td>" . $_SESSION['sdrug_id'][$i], "</td><td>";
                            echo $_SESSION['drug_name_eng'][$i], "</td><td>";
                            echo $_SESSION['all'][$i] . " " . $_SESSION['unit'][$i], "</td>";

                            echo "<td><input type='text' disabled  required='' name='price[]' size=8 value=", $_SESSION['drug_price'][$i], "></td>";


                            echo "<td width=\"20%\">

<input    onkeypress=\"return checknum2()\" size='8' type='text' name='amount[]'  value=", $_SESSION['drug_amount'][$i], "></td>";

                            $sum_price = $_SESSION['drug_price'][$i] * $_SESSION['drug_amount'][$i];


                            echo "<td>";
                            printf("%.2f", $sum_price);//แสดงผมในรูปแบบ ทศนิยม
                            echo " บาท</td></tr>";


                            $total_price += $sum_price;

                        }


                        echo "<tr>
               <td> <button class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=treatment&action=insert_treatment&active=active13&chk_del=$val'><i class='fa fa-times'></i>
               </button></td>
               <td colspan=5 style='text-align:right;font-weight:bold';>รวมทั้งหมด</td>

               <td style='text-align:center;font-weight:bold';>";
                        printf("%.2f", $total_price);
                        echo " บาท </td></tr>";

                        echo "</tbody>";
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<td colspan='7'>";
                        echo "<ul class='pagination pull-right'></ul>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<input type='hidden' name='total_price' value='$total_price'";


                        echo "</tfoot>";

                        echo "</table>";

                        echo "<input type='submit' class='btn btn-w-m btn-danger' name='button'  onclick='return confirm(\"ต้องการยกเลิกรายการนี้  ?\")' value='ยกเลิกการทำรายการ'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                        echo "<input type='submit' class='btn btn-w-m btn-warning' name='button' value='คำนวณใหม่'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                        echo "<input type='submit' class='btn btn-w-m btn-info' name='button' onclick='return confirm(\"ยืนยันการจ่ายยา  ?\")' value='ยืนยันการจ่ายยา'>";

                        echo "</form>";

                    } else {

                        echo "<p align='center'>ยังไม่มีการเลือก</p>";
                    }

                }


                ?>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">


//    function checktext2(e){
//        var keyPressed;
//        if(window.event){ // IE
//            if (event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122 && (keyPressed < 3585) || (keyPressed > 3659)){
//                event.returnValue = false;
//            }
//        }else{
//            keyPressed = e.which; // Firefox
//            alert(keyPressed);
//            if (keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122) && (keyPressed < 3585) || (keyPressed > 3659)){
//                keyPressed = e.preventDefault();
//            }
//        }
//    }
//
//    function checktext(e){
//        var keyPressed;
//        if(window.event){ // IE
//            if ( event.keyCode < 48 || event.keyCode > 57 && event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122){
//                event.returnValue = false;
//            }
//        }else{
//            keyPressed = e.which; // Firefox
//            if (keyPressed != 8 && (keyPressed < 48) && (keyPressed > 57) || keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122) ){
//                keyPressed = e.preventDefault();
//            }
//        }
//    }
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
                    range: "กรุณากรอกจำนวนให้ถูกต้อง"

                }


            }

        });



    });
</script>