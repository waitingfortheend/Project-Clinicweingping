<?php
include("../../include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');


?>
<?php
$sql_drug = mysqli_query($conn,"select d_id from drug  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
while (list($d_id) = mysqli_fetch_array($sql_drug)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

    $new_id = mysql_result(mysqli_query($conn,"Select Max(substr(d_id,-5))+1 as d_id from drug"), 0, "d_id");//เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย


    if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
        $c_id = "";
    } else {
        $c_id = "D" . sprintf("%05d", $new_id);//ถ้าไม่ใช่ค่าว่าง
    }

}


?>


<form role="form" id="form" method="post" action="index.php?module=drug&action=insert_drug" class="form-horizontal"
      enctype="multipart/form-data">
    <div class="form-group"><label class="col-sm-2 control-label ">ชื่อ(Eng)</label>
        <div class="col-sm-8"><input type="text"  name="d_eng" required placeholder=""
                                     class="form-control"></div>
    </div>

    <div class="form-group"><label class="col-sm-2 control-label">ชื่อ(Thai)</label>

        <div class="col-sm-8"><input type="text"  name="d_th" required placeholder=""
                                     class="form-control" name="password"
            ></div>
    </div>

    <div class="form-group"><label class="col-sm-2 control-label">รายละเอียด</label>
        <div class="col-sm-8"><textarea name="d_detail" required  placeholder=""
                                        class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group"><label class="col-sm-2 control-label">ราคาซื้อ</label>
        <div class="col-sm-5">
            <input type="text" name="d_price" required class="form-control" placeholder="">

        </div>

        <label class="col-sm-0 control-label">บาท</label>
    </div>

    <div class="form-group"><label class="col-sm-2 control-label">ราคาขาย</label>
        <div class="col-sm-5">
            <input type="text" name="d_sprice" required class="form-control" placeholder="">
        </div>
        <label class="col-sm-0 control-label">บาท</label>
    </div>


    <div class="form-group"><label class="col-sm-2 control-label">จำนวน</label>
        <div class="col-sm-5">
            <input type="text" name="d_amount" required placeholder="" class="form-control">
        </div>
    </div>

    <div class="form-group"><label class="col-sm-2 control-label">หน่วยนับ</label>
        <div class="col-sm-5">
            <input type="text" name="d_unit" required placeholder="" class="form-control">
        </div>
    </div>


    <?php
    $today = date("d/m/Y");

    ?>


    <div class="form-group" id="data_5">
        <label class="col-sm-2 control-label">วันหมดอายุ</label>
        <div class="input-daterange input-group" id="datepicker">
            <input type="text" class="input-sm form-control" name="mfg" required value="<?php echo $today; ?>"/>
            <span class="input-group-addon">to</span>
            <input type="text" class="input-sm form-control" name="exp" required value="<?php echo $today; ?>"/>
        </div>
    </div>

    <div class="hr-line-dashed"></div>


    <div class="form-group"><label class="col-sm-2 control-label">กรุณาเลือกรูป <br/>
            <small class="text-navy"></small>
        </label>
        <label title="Upload image file" for="inputImage" class="btn btn-primary">
            <input type="file" accept="image/jpeg" name="d_picture">
            เลือกรูปภาพ
        </label>
    </div>

    <div class="hr-line-dashed"></div>


    <?php

    $sql_type = mysqli_query($conn,"select * from type_drug  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


    ?>

    <div class="form-group"><label class="col-sm-3 control-label ">เลือกประเภทยา </label>

        <div class="col-sm-8">
            <select name="type_d_id" data-placeholder="Choose a Type..." class="select2_demo_2 form-control"
                    tabindex="2">

                <option value=''>กรุณาเลือก</option>

                <?php
                while (list($cus_id, $cus_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                    echo "<option value=$cus_id>รหัส $cus_id  $cus_name  </option>";

                }
                ?>
            </select>
        </div>
    </div>

    <div class="hr-line-dashed"></div>


    <input type='hidden' name='d_id' value="<?php echo $c_id ?>">


    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
        </div>
    </div>


</form>


<script>
    $(document).ready(function () {

        $("#form").validate({
            rules: {
                d_eng: {

                    required: true,
                    maxlength: "70",
                    ruleSD: "^[^'\"กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ]+$"
                },
                d_th: {

                    required: true,
                    maxlength: "70",
                    ruleSD: "^[^'\"AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz]+$"
                },
                d_detail: {

                    required: true,
                    ruleSD: "^[^'\"]+$"
                },
                d_price: {
                    number: true,
                    required: true,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$",
                    range: [1,1000000],
                },
                d_sprice: {
                    number: true,
                    required: true,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$",
                    range: [1,1000000],
                },
                d_amount: {
                    number: true,
                    required: true,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$",
                    range: [1,1000000],
                },
                d_unit: {

                    required: true,
                    maxlength: "30",
                    ruleSD: "^[^'\"]+$"

                },
                type_d_id: {

                    required: true,
                    ruleSD: "^[^'\"]+$"

                }, mfg: {

                    required: true,
                    ruleSD: "^[^'\"]+$"
                }, exp: {

                    required: true,

                    ruleSD: "^[^'\"]+$"
                }

            },
            messages: {
                d_eng: {
                    maxlength: "กรุณาระบุไม่เกิน 70 ตัวอักษร",
                    required: "กรุณากรอกชื่อยาภาษาอังกฤษ",
                    ruleSD: "กรุณากรอกข้อมูลเป็นภาษาอังกฤษ และ งดใช้อักษระ single qoute หรือ double qoute"
                },
                d_th: {
                    maxlength: "กรุณาระบุไม่เกิน 70 ตัวอักษร",
                    required: "กรุณากรอกชื่อยาภาษาไทย",
                    ruleSD: "กรุณากรอกข้อมูลเป็นภาษาไทย และงดใช้อักษระ single qoute หรือ double qoute"
                }, d_detail: {

                    required: "กรุณากรอกรายละเอียดยา",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                d_price: {
                    maxlength: "กรุณาระบุจำนวนเงินไม่เกิน 10 ตัวอักษร",
                    required: "กรุณากรอกราคาซื้อ",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                    range: "กรุณากรอกราคาซื้อให้ถูกต้อง",
                },
                d_sprice: {
                    maxlength: "กรุณาระบุจำนวนเงินไม่เกิน 10 ตัวอักษร",
                    required: "กรุณากรอกราคาขาย",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                    range: "กรุณากรอกราคาขายให้ถูกต้อง",
                },
                d_unit: {
                    maxlength: "กรุณาระบุไม่เกิน 30 ตัวอักษร",
                    required: "กรุณากรอกหน่วยนับ",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",

                },
                type_d_id: {

                    required: "กรุณาเลือกประเภทยา",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, mfg: {

                    required: "กรุณาเลือกวันที่",

                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, exp: {
                    required: "กรุณาเลือกวันที่",

                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, d_amount: {
                    maxlength: "กรุณากรอจำนวนไม่เกิน 10 ตัว",
                    required: "กรุณากรอกจำนวน",
                    ruleSD: "กรุณากรอกข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                    range: "กรุณากรอกจำนวนให้ถูกต้อง"
                }


            }

        });
    });

</script>

<script type="text/javascript">


    //    function checkeng(e){
    //        var keyPressed;
    //        if(window.event){ // IE
    //            if (event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122 ){
    //                event.returnValue = false;
    //            }
    //        }else{
    //            keyPressed = e.which; // Firefox
    //            alert(keyPressed);
    //            if (keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122) ){
    //                keyPressed = e.preventDefault();
    //            }
    //        }
    //    }
    //
    //
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
        autoclose: true,
        format: "dd/mm/yyyy"
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