<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");

?>
<form role="form" id="form" method="post" action="index.php?module=disease&action=insert_disease" class="form-horizontal">


    <label class="col-sm-5 control-label ">ประเภทสัตว์</label>
    <div class="form-group">

            <?php

            $sql_type = mysqli_query($conn,"select * from pet_type WHERE pet_type ='1' or pet_type='2'");
            $chk="";
            while (list($sql_type_id, $type_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                    if($sql_type_id==1){
                        $chk="checked";


                    }else{
                        $chk="";
                    }
                

                ?>


                <input <?php echo $chk;  ?> class="big" type="radio" value="<?php echo $sql_type_id; ?>" name="type_pet"  ><?php echo $type_name; ?> &nbsp;&nbsp;


                <?php
            }

            ?>

    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label ">ชื่อโรค</label>
        <div class="col-sm-8">
            <input type="text" name="diseasetypename" required placeholder="" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label ">รายละเอียด</label>
        <div class="col-sm-8">
            <textarea style="height: 200px" name="diseasedetail" required placeholder="" class="form-control"></textarea>
        </div>
    </div>



    
    <div class="form-group">
        <label class="col-sm-2 control-label ">อาการโรค</label>
        <div class="col-sm-8">
            <textarea style="height: 100px" name="sym_detail" required placeholder="" class="form-control"></textarea>
        </div>
        <font style="color: red"> * ขั้นด้วย ( , )</font>

    </div>

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
        </div>
    </div>
</form>

<style>
    .big {
        width: 20px;
        height: 20px;

    }
</style>

<script>
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

                }, sym_detail: {

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
                }, sym_detail: {

                    required: "กรุณากรอกอาการโรค",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }
            }

        });
    });


</script>



