<?php
include("../../include/connect_db.php");

$diseaseid = $_POST['disease_id'];


$sql_dis = mysqli_query($conn,"select * from diseasetype where diseasetypeid ='$diseaseid' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


list($dis_id, $dis_name, $dis_detail, $pet_type) = mysqli_fetch_array($sql_dis);


?>

<form role="form" id="form" method="post" action="index.php?module=disease&action=update_disease"
      class="form-horizontal">

    <label class="col-sm-5 control-label ">ประเภทสัตว์</label>
    <div class="form-group">

        <?php

        $sql_type = mysqli_query($conn,"select * from pet_type WHERE pet_type ='1' or pet_type='2'");
        $chk = "";
        while (list($sql_type_id, $type_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

            if ($sql_type_id == $pet_type) {
                $chk = "checked";


            } else {
                $chk = "";
            }


            ?>


            <input <?php echo $chk; ?> class="big" type="radio" value="<?php echo $sql_type_id; ?>"
                                       name="type_pet"  ><?php echo $type_name; ?> &nbsp;&nbsp;


            <?php
        }

        ?>

    </div>


    <input type="hidden" name="id" value="<?php echo $diseaseid ?>">
    <div class="form-group">
        <label class="col-sm-2 control-label ">ชื่อโรค</label>
        <div class="col-sm-8">
            <input type="text" name="diseasetypename" required placeholder="" class="form-control"
                   value="<?php echo $dis_name; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label ">รายละเอียด</label>
        <div class="col-sm-8">
            <textarea style="height: 200px;text-align:justify" name="diseasedetail" required placeholder=""
                      class="form-control"><?php echo $dis_detail; ?></textarea>
        </div>
    </div>
    <?php


    $sql_sym = mysqli_query($conn,"select * from symptoms where diseasetypeid ='$diseaseid' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

    while (list($sym_id, $sym_detail, $diseasetypeid) = mysqli_fetch_array($sql_sym)) {

        $symid[] = $sym_id;
        $symdetail[] = $sym_detail;


    }

    ?>


    <?php

    if(!empty($symid)){



    $count = count($symid);

    for ($i = 0;
         $i < $count;
         $i++) {


        ?>
        <div class="form-group">

            <label class="col-sm-3 control-label ">รหัสอาการ <?php echo $symid[$i] ?></label>
            <input type="hidden" name="sym_id[]" required value="<?php echo $symid[$i] ?>">
            <div class="col-sm-6">
                <input type="text" name="symdetail[]"  required  placeholder="" class="form-control"
                       value="<?php echo $symdetail[$i] ?>">
            </div>
            <label class="control-label">
            <?php

            echo "<a  class=\"btn btn-xs btn-danger\" href='index.php?module=disease&action=delete_sym&active=active26&sym_id=$symid[$i]' onclick='return confirm(\"คุณต้องการลบข้อมูล $symid[$i] ? \")';>";
            ?>
            <i class="fa fa-minus-square"></i> | ลบ </a>
            </label>
        </div>


        <?php
    }

    }else{

        echo " <label class=\"col-sm-8 control-label \">ไม่พบอาการสำหรับโรคนี้</label><br><br>";
    }

    ?>

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">แก้ไข</button>
        </div>
    </div>

</form>



<script>
//        function checktext2(e){
//            var keyPressed;
//            if(window.event){ // IE
//                if (event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122 && (keyPressed < 3585) || (keyPressed > 3659)){
//                    event.returnValue = false;
//                }
//            }else{
//                keyPressed = e.which; // Firefox
//                alert(keyPressed);
//                if (keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122) && (keyPressed < 3585) || (keyPressed > 3659)){
//                    keyPressed = e.preventDefault();
//                }
//            }
//        }

$(document).ready(function() {

    $("#form").validate({
        rules: {
            diseasetypename: {

                required: true,
                maxlength: "50",
                ruleSD: "^[^'\"]+$"
            }, diseasedetail: {

                required: true,
                ruleSD: "^[^'\"]+$"

            }, 'symdetail[]': {

                required: true,
                ruleSD: "^[^'\"]+$"
            }

        }, messages: {
            diseasetypename: {
                maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                required: "กรุณากรอกชื่อโรค",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }, diseasedetail: {

                required: "กรุณากรอกรายละเอียด",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }, 'symdetail[]': {

                required: "กรุณากรอกอาการโรค",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }
        }

    });

});


</script>
