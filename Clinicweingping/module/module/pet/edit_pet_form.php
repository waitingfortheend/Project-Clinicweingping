<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee" and  $_SESSION['login_type']!="Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');

?>

<?php

@$pet_id = $_POST['pet_id'];

@$sql_pet = mysqli_query($conn,"select * from pet where pet_id='$_POST[pet_id]'") or die(mysql_error());
list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);


?>


<form role="form" id="form" method="post" action="index.php?module=pet&action=update_pet" class="form-horizontal"
      enctype="multipart/form-data">


    <div class="form-group "><label class="col-sm-3 control-label ">ชื่อ</label>
        <div class="col-sm-6"><input type="text" name="pet_name"  placeholder="ชื่อสัตว์" class="form-control"
                                      value="<?php echo $pet_name ?>"></div>
    </div>



    <div class="form-group "><label class="col-sm-3 control-label ">ประเภทสัตว์ </label>
        <div class="col-sm-6">
            <select name="pet_type" data-placeholder="Choose a Type..." class="select2_demo_2 form-control"
                    tabindex="2">
                <?php $sql_type = mysqli_query($conn,"select * from pet_type");
                $pettype = mysqli_query($conn,"select * from pet_type where pet_type = $pet_type");
                list($sql_type_id_2, $type_name_2) = mysqli_fetch_array($pettype);

                echo "<option selected value='$sql_type_id_2'>$type_name_2</option> ";

                while (list($sql_type_id, $type_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    if ($sql_type_id_2 != $sql_type_id) {

                        echo "<option value=$sql_type_id>$type_name</option> ";

                    }


                }
                ?>


            </select>
        </div>
    </div>



    <div class="form-group"><label class="col-sm-3 control-label ">พันธุ์สัตว์</label>
        <div class="col-sm-6"><input type="text"

                                     name="pet_species" placeholder="พันธุ์" class="form-control"
                                    value="<?php echo $pet_species ?>"></div>
    </div>


    <?php


    $year = substr($pet_age, 0, 4);
    $month = substr($pet_age, 5, 2);
    $day = substr($pet_age, 8, 2);
    $pet_age1 = $day . "/" . $month . "/" . $year;

    ?>


    <div class="hr-line-dashed"></div>

    <div class="form-group"><label class="col-sm-3 control-label ">วันที่เกิด</label>

        <div class="form-group" id="data_2">
            <div class="col-md-6">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                                                                                                class="form-control"
                                                                                                name="pet_age"
                                                                                                value="<?php echo $pet_age1 ?>">
                </div>
            </div>
        </div>

    </div>


    <div class="form-group "><label class="col-sm-3 control-label">กรุณาเลือกเพศ <br/>
            <small class="text-navy"></small>
        </label>
        <?php $chk1 = "";
        $chk2 = "";
        if($pet_sex=="M"){
            $chk1 = "checked";
        }else if($pet_sex=="F"){
            $chk2 = "checked";
        }

        ?>

        <div class="col-sm-8">
            <div class="i-checks"><label> <input <?php echo $chk1; ?> type="radio" class="big" checked="" value="M" name="pet_sex"> <i></i>
                    เพศผู้
                </label>

                <label> <input <?php echo $chk2; ?>  type="radio" class="big" value="F" name="pet_sex"> <i></i> เพศเมีย </label></div>
        </div>

    </div>
    <div class="hr-line-dashed"></div>


    <div class="form-group "><label class="col-sm-3 control-label">กรุณาเลือกรูป <br/>
            <small class="text-navy"></small>
        </label>
        <label title="Upload image file" for="inputImage" class="btn btn-primary">
            <input type="file" accept="image/jpeg" name="pet_picture">
            Upload new image
        </label>
    </div>

    <div class="hr-line-dashed"></div>


    <?php

    $sql_cus = mysqli_query($conn,"select cus_id,cus_name,cus_surname,cus_address,cus_telephone from customer order by cus_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
    $sql_cus2 = mysqli_query($conn,"select cus_id,cus_name,cus_surname,cus_address,cus_telephone from customer WHERE  cus_id ='$cus_id' order by cus_id DESC ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
    list($cus_id1, $cus_name1, $cus_surname1, $cus_address1, $cus_telephone1) = mysqli_fetch_array($sql_cus2);
    ?>

    <div class="form-group "><label class="col-sm-3 control-label ">เลือกเจ้าของสัตว์ </label>

        <select name="cus_id" data-placeholder="Choose a Type..." class="chosen-select" style="width:345px;"
                tabindex="2">


            <option
                value="<?php echo "$cus_id"; ?>"><?php echo "รหัส $cus_id  ชื่อ $cus_name1  $cus_surname1"; ?></option>


            <?php
            while (list($cus_id2, $cus_name, $cus_surname, $cus_address, $cus_telephone) = mysqli_fetch_array($sql_cus)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                if ($cus_id != $cus_id2) {


                    echo "<option value=$cus_id2>รหัส $cus_id2 ชื่อ $cus_name  $cus_surname</option>";
                }
            }
            ?>
        </select>
    </div>


    <input type="hidden" name="pet_id" placeholder="" class="form-control" value="<?php echo $pet_id ?>">


    <br>
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-5">
            <!--                       <button class="btn btn-white"  type="button" onclick="window.location='index.php?module=pet&action=pet_manage&active=active5'">ยกเลิก</button>-->
            <button class="btn btn-primary" type="submit" name="submit">แก้ไข</button>
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
//                date:true

                },
                pet_sex: {

                    required: true

                },
                cus_id: {
                    required: true

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