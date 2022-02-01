<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee" and $_SESSION['login_type'] != "Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

@include("../../include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');

?>


<form role="form" id="form" method="post" action="index.php?module=pet&action=insert_pet" class="form-horizontal"
      enctype="multipart/form-data">


    <div class="form-group"><label class="col-sm-3 control-label ">ชื่อ</label>
        <div class="col-sm-6"><input type="text"
                                     name="pet_name" placeholder="ชื่อสัตว์" required class="form-control"></div>
    </div>


    <div class="form-group"><label class="col-sm-3 control-label ">เลือกประเภทสัตว์ </label>
        <div class="col-sm-6">

            <select name="pet_type" data-placeholder="Choose a Type..." required class="select2_demo_2 form-control"
                    tabindex="2">
                <option value=''>กรุณาเลือก</option>
                <?php $sql_type = mysqli_query($conn,"select * from pet_type");
                while (list($sql_type_id, $type_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    echo "<option value=$sql_type_id>$type_name</option> ";

                    ?>

                <?php } ?>
            </select>

        </div>
    </div>


    <div class="form-group"><label class="col-sm-3 control-label ">พันธุ์สัตว์</label>
        <div class="col-sm-6"><input type="text" required  name="pet_species"
                                     placeholder="พันธุ์" class="form-control"></div>
    </div>


    <?php
    $today = date("m/d/Y");


    ?>

    <div class="hr-line-dashed"></div>

    <div class="form-group"><label class="col-sm-3 control-label ">วันที่เกิด</label>

        <div class="form-group" id="data_2">
            <div class="col-md-5">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" required
                                                                                                class="form-control"
                                                                                                name="pet_age"
                                                                                                value="<?php echo $today ?>">
                </div>
            </div>
        </div>


    </div>
    <div class="form-group"><label class="col-sm-3 control-label">กรุณาเลือกเพศ <br/>
            <small class="text-navy"></small>
        </label>

        <div class="col-sm-8">
            <div class="i-checks"><label> <input type="radio" class="big" checked="" value="M" name="pet_sex"> <i></i>
                    เพศผู้ </label>
                <label> <input type="radio" class="big" value="F" name="pet_sex"> <i></i> เพศเมีย </label></div>
        </div>

    </div>
    <div class="hr-line-dashed"></div>


    <div class="form-group"><label class="col-sm-3 control-label">กรุณาเลือกรูป <br/>
            <small class="text-navy"></small>
        </label>
        <label title="Upload image file" for="inputImage" class="btn btn-primary">
            <input type="file" accept="image/jpeg" ept="image/jpeg" name="pet_picture">
            Upload new image
        </label>
    </div>

    <div class="hr-line-dashed"></div>


    <?php

    $sql_cus = mysqli_query($conn,"select cus_id,cus_name,cus_surname,cus_address,cus_telephone from customer order by cus_id DESC   ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


    ?>

    <div class="form-group"><label class="col-sm-3 control-label ">เลือกเจ้าของสัตว์ </label>

        <div class="col-sm-6">

            <select name="cus_id" data-placeholder="กรุณาเลือก" required class="chosen-select form-control"
                    tabindex="2">


                <?php
                while (list($cus_id, $cus_name, $cus_surname, $cus_address, $cus_telephone) = mysqli_fetch_array($sql_cus)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    echo "<option value=$cus_id>รหัส $cus_id ชื่อ $cus_name  $cus_surname</option>";

                }
                ?>
            </select>
        </div>
    </div>


    <br>
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


<script type="text/javascript">

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#data_2 .input-group.date').datepicker({
        startView: 1,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('#data_3 .input-group.date').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $('#data_4 .input-group.date').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true
    });

    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

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
</script>


<script>



    $(document).ready(function () {
        $("#form").validate({
            rules: {
                pet_name: {

                    required: true,
                    maxlength: "20",
                    ruleSD: "^[^'\"]+$"

                },
                pet_type: {

                    required: true,
                    ruleSD: "^[^'\"]+$"
                },
                pet_species: {

                    required: true,
                    maxlength: "50",
                    ruleSD: "^[^'\"]+$"
                },
                pet_age: {

                    required: true,
                    ruleSD: "^[^'\"]+$"


                },
                pet_sex: {

                    required: true,

                },
                cus_id: {
                    required: true,

                }

            }, messages: {
                pet_name: {
                    maxlength: "กรุณาระบุไม่เกิน 20 ตัวอักษร",
                    required: "กรุณากรอกชื่อสัตว์",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                pet_type: {

                    required: "กรุณาเลือกประเภทสัตว์",

                },
                pet_species: {
                    maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                    required: "กรุณากรอกพันธุ์สัตว์",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                pet_age: {
                    date: "กรุณากรอกวันที่",
                    required: "กรุณาเลือกวันที่เกิด",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, cus_id: {
                    required: "กรุณาเลือกเจ้าของสัตว์",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }

            }
        });
    });
    
</script>