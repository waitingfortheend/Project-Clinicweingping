<?php

include ("../../include/connect_db.php");

?>


<?php
$sql =mysqli_query($conn,"select * from user where user_name='$_POST[user_name]'  ")or die(mysql_error());
list($user_name,$password,$type_id)=mysqli_fetch_array($sql);

?>

<form method="post" role="form" id="form" action="index.php?module=permissions&action=update_permissions" class="form-horizontal">

    <div class="form-group"><label class="col-sm-3 control-label ">Username</label>
        <div class="col-sm-6"><input type="text" name="user22" disabled class="form-control" required="" value="<?php echo $user_name?>"></div>
    </div>

    <input type="hidden" name="user" placeholder="Username" class="form-control" required="" value="<?php echo $user_name?>">

    <div class="form-group"><label class="col-sm-3 control-label" required="" value="<?php echo $password?>">Password</label>
        <input type="hidden" name="user" placeholder="Username" class="form-control" required="" value="<?php echo $user_name?>">

        <div class="col-sm-6"><input type="text" name="pass"   placeholder="Password" class="form-control" name="password" required="" value="<?php echo $password?>"></div>

<!--        <input type="hidden" name="pass"  placeholder="Password" class="form-control" name="password" required="" value="--><?php //echo $password?><!--">-->
    </div>



    <div class="form-group "><label class="col-sm-3 control-label" >สิทธิ์ผู้ใช้งาน</label>

        <div class="col-sm-6"><select name="type" class="form-control m-b" required="">
                <?php


                echo "<option value ='$type_id' >$type_id</option>";
                if($type_id=="Employee"){
                    echo "<option>Veterinary</option>";
                    echo "<option>Owner</option>";
//                    echo "<option>Admin</option>";


                }elseif($type_id=="Veterinary"){

                    echo "<option>Employee</option>";
                    echo "<option>Owner</option>";
//                    echo "<option>Admin</option>";

                }elseif($type_id=="Owner"){
                    echo "<option>Veterinary</option>";
                    echo "<option>Employee</option>";
//                    echo "<option>Admin</option>";

                }
//                elseif($type_id=="Admin"){
//                    echo "<option>Veterinary</option>";
//                    echo "<option>Employee</option>";
//                    echo "<option>Owner</option>";
//
//
//                }


                ?>



            </select>


        </div>
    </div>

    <div class="form-group has-warning">
        <div class="col-sm-4 col-sm-offset-5">
            <!--                          <button class="btn btn-white"  type="button" onclick="window.location='index.php?module=user&action=user_manage&active=active1'">ยกเลิก</button>-->
            <button class="btn btn-primary" type="submit" name="submit" >บันทึก</button>
        </div>
    </div>


</form>


<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {

                pass: {
                    ruleSD: "^[^'\"!@#$%&*()-+*/^., £กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ]+$",
                    required: true,
                    minlength: 6,
                    maxlength: 10,

                }

            }, messages: {

                pass: {
                    minlength: "กรุณากรอกข้อมูลอย่างน้อย 6 ตัวอักษร",
                    maxlength: "กรุณากรอกข้อมูลไม่เกิน 10 ตัวอักษร",
                    required: "กรุณากรอกรหัสผ่าน",
                    ruleSD: "กรุณากรอกตัวอักษรภาษาอังกฤษ ไม่สามารถใช้อักขระพิเศษได้"
                }

            }

        });
    });

</script>