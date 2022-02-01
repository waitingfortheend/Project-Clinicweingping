<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee" and  $_SESSION['login_type']!="Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include ("../../include/connect_db.php");


@$type = $_POST['type_d_id'];

@$sql_type =mysqli_query($conn,"select * from pet_type where pet_type='$_POST[type_d_id]'")or die(mysql_error());
list($type_d_id,$type_name)=mysqli_fetch_array($sql_type);


?>






<form id="form" role="form" method="post" action="index.php?module=pet&action=update_pet_type" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group"><label class="col-sm-3 control-label ">ชื่อประเภทสัตว์</label>
        <div class="col-sm-8"><input type="text" name="type_name" placeholder="" class="form-control" required="" value="<?php echo $type_name?>"></div>
    </div>
    <div class="hr-line-dashed"></div>

    <input type='hidden' name='type_d_id'  value="<?php echo $type_d_id ?>">


    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit" >แก้ไข</button>
        </div>
    </div>


</form>

<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                type_name: {
                    required: true,
                    maxlength: "20",
                    ruleSD: "^[^'\"]+$"

                }

            }, messages: {
                type_name: {
                    maxlength: "กรุณาระบุไม่เกิน 20 ตัวอักษร",
                    required: "กรุณากรอกประเภทสัตว์",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }

            }
        });
    });
</script>