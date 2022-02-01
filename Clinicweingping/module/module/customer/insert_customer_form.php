<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}


@include("../../include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');
?>



<?php
$sql_cus = mysqli_query($conn,"select cus_id from customer  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
while (list($cus_id) = mysqli_fetch_array($sql_cus)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

    $new_id = mysql_result(mysqli_query($conn,"Select Max(substr(cus_id,-5))+1 as cus_id from customer"), 0, "cus_id");//เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย


    if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
        $c_id = "C00001";
    } else {
        $c_id = "C" . sprintf("%05d", $new_id);//ถ้าไม่ใช่ค่าว่าง
    }

}
?>


<form role="form" id="form" method="post" action="index.php?module=customer&action=insert_customer"
      class="form-horizontal">
    <div class="form-group"><label class="col-sm-3 control-label ">ชื่อ</label>
        <div class="col-sm-8"><input type="text" onkeypress="return checktext2()" required name="cus_name"
                                     placeholder="ชื่อ" class="form-control  "></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">นามสกุล</label>

        <div class="col-sm-8"><input type="text" onkeypress="return checktext2()" required name="cus_surname"
                                     placeholder="นามสกุล" class="form-control" name="password"></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">ที่อยู่</label>
        <div class="col-sm-8"><textarea name="cus_address" placeholder="ที่อยู่" required
                                        class="form-control"></textarea></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
        <div class="col-sm-8">
            <input type="text" name="cus_telephone" placeholder="เบอร์โทรศัพท์" required class="form-control">


        </div>
    </div>


    <input type='hidden' name='cus_id' value="<?php echo $c_id ?>">


    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
        </div>
    </div>


</form>


<script>


    //    function checktext2(e) {
    //        var keyPressed;
    //        if (window.event) { // IE
    //            if (event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122 && (keyPressed < 3585) || (keyPressed > 3659)) {
    //                event.returnValue = false;
    //            }
    //        } else {
    //            keyPressed = e.which; // Firefox
    //            alert(keyPressed);
    //            if (keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122) && (keyPressed < 3585) || (keyPressed > 3659)) {
    //                keyPressed = e.preventDefault();
    //            }
    //        }
    //    }
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                cus_name: {

                    required: true,
                    maxlength: 50,
                    ruleSD: "^[^'\"]+$"
                },
                cus_surname: {

                    required: true,
                    maxlength: 50,
                    ruleSD: "^[^'\"]+$"
                },
                cus_address: {

                    required: true,
                    ruleSD: "^[^'\"]+$"

                },
                cus_telephone: {

                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                }

            }, messages: {
                cus_name: {
                    maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                    required: "กรุณากรอกชื่อลูกค้า",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, cus_surname: {
                    maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                    required: "กรุณากรอกนามสกุลลูกค้า",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, cus_address: {

                    required: "กรุณากรอกที่อยู่ลูกค้า",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, cus_telephone: {
                    minlength: "กรุณากรอกเบอร์โทร 10 เลข",
                    maxlength: "กรุณากรอกเบอร์โทร 10 เลข",
                    required: "กรุณากรอกเบอร์โทรศัพท์",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }

            }
        });
    });
</script>