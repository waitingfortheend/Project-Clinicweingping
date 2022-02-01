<?php
@session_start();
if (empty($_SESSION['valid_user'])) {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");




$user_name = $_POST['user_name'];
$sql_user = mysqli_query($conn,"select password from user where user_name='$user_name'") or die(mysql_error());

list($pass) = mysqli_fetch_array($sql_user);

?>
<form role="form" id="form" method="post" action="index.php?module=user&action=update_pass" class="form-horizontal">

        <input type="hidden"  onkeypress="return checktext()" id="pass3" name="pass3" placeholder="Username" value="<?php  echo $pass;  ?>"
    class="form-control">



    <div class="form-group"><label class="col-sm-3 control-label ">ชื่อผู้ใช้</label>
        <div class="col-sm-7"><input type="text" disabled onkeypress="return checktext()" name="user1" placeholder="Username" value="<?php  echo $user_name;  ?>"
                                     class="form-control"></div>

    </div>

   <input type="hidden" onkeypress="return checktext()" name="user" placeholder="Username" value="<?php  echo $user_name;  ?>"
                                 class="form-control">

    <div class="form-group"><label class="col-sm-3 control-label">รหัสผ่านเดิม</label>

        <div class="col-sm-7"><input type="password" required onkeypress="return checknum()" name="pass" placeholder="รหัสผ่านเดิม"
                                     class="form-control"
                                     name="password"></div>
    </div>
    <div class="form-group"><label class="col-sm-3 control-label">รหัสผ่านใหม่</label>

        <div class="col-sm-7"><input type="password" required onkeypress="return checknum()" id="pass1" name="pass1" placeholder="รหัสผ่านใหม่"
                                     class="form-control"
                                     name="password"></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">ยืนยันรหัสผ่านใหม่</label>

        <div class="col-sm-7"><input type="password" required onkeypress="return checknum()" name="pass2" placeholder="ยืนยัน รหัสผ่านใหม่"
                                     class="form-control"
                                     name="password"></div>
    </div>


    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">แก้ไข</button>
        </div>
    </div>

</form>


<script>

    function checknum(e) {
        var keyPressed;
        if (window.event) { // IE
            if (event.keyCode < 48 || event.keyCode > 57 && event.keyCode != 32 && (event.keyCode < 97) || event.keyCode > 122) {
                event.returnValue = false;
            }
        } else {
            keyPressed = e.which; // Firefox
            if (keyPressed != 8 && (keyPressed < 48) && (keyPressed > 57) || keyPressed != 8 && (keyPressed < 97) || (keyPressed > 122)) {
                keyPressed = e.preventDefault();
            }
        }
    }
    $(document).ready(function () {
        $("#form").validate({

            rules: {

                pass: {
                    equalTo: "#pass3",
                    required: true,
                    minlength: 6,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$"
                }, pass1: {
                    required: true,
                    minlength: 6,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$"
                }, pass2: {
                    required: true,
                    equalTo: "#pass1",
                    ruleSD: "^[^'\"]+$"
                }

            }, messages: {
                pass: {

                    required: "กรุณากรอกรหัสผ่านเดิม",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                    equalTo: "กรุณากรอกรหัสผ่านให้ตรงกับรหัสเดิม"
                }, pass1: {
                    minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
                    required: "กรุณากรอกรหัสผ่านใหม่",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }, pass2: {

                    required: "กรุณากรอกรหัสผ่านใหม่อีกครั้ง",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                    equalTo: "กรุณากรอกรหัสผ่านให้ตรงกับรหัสเดิม"
                }

            }
        });
    });
</script>