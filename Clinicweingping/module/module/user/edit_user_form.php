<?php
    @session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Owner") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

@include("../../include/connect_db.php");


?>



<?php
             @$sql =mysqli_query($conn,"select * from user where user_name='$_POST[user_name]'")or die(mysql_error());
             list($user_name,$password,$type_id)=mysqli_fetch_array($sql);
             @$sql_emp =mysqli_query($conn,"select * from employee where user_name='$_POST[user_name]'")or die(mysql_error());
             list($emp_id,$emp_name,$emp_surname,$emp_address,$emp_telephone,$emp_user)=mysqli_fetch_array($sql_emp);

            ?>

               <form role="form" id="form" method="post" action="index.php?module=user&action=update_user" class="form-horizontal">

                  <div class="form-group"><label class="col-sm-3 control-label ">Username</label>
                       <div class="col-sm-7">  <input type="text" name="user2" disabled placeholder="Username" class="form-control"  value="<?php echo $user_name?>"></div>

                  </div>

                      <input type="hidden" name="user" placeholder="Username" class="form-control" value="<?php echo $user_name?>"></div>

                   <div class="form-group"><label class="col-sm-3 control-label"  value="<?php echo $password?>">Password</label>

                       <div class="col-sm-7"><input type="text" name="pass"  placeholder="Password" class="form-control" name="password"  value="<?php echo $password?>"></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">ชื่อ</label>
                       <div class="col-sm-7"><input type="text" name="name" placeholder="Name" class="form-control"  value="<?php echo $emp_name ?>"></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">นามสกุล</label>
                       <div class="col-sm-7"><input type="text" name="surname" placeholder="Surname" class="form-control"  value="<?php echo $emp_surname ?>"></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">ที่อยู่</label>
                       <div class="col-sm-7"><textarea name="address" placeholder="Address" class="form-control" ><?php echo $emp_address ?></textarea></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
                       <div class="col-sm-7">
                        <input type="text" name="tel" placeholder="Telephone" class="form-control" class="form-control" value="<?php echo $emp_telephone ?>">


                        </div>

                  </div>


                  <div class="form-group "><label class="col-sm-3 control-label" >สถานะ</label>

                      <div class="col-sm-5"><select name="type" class="form-control m-b" required="">
                        <?php


                        echo "<option value ='$type_id' >$type_id</option>";
                        if($type_id=="Employee"){

                          echo "<option>Veterinary</option>";
                        }elseif($type_id=="Veterinary"){

                            echo "<option>Employee</option>";
                        }

                        ?>


<!--                          <option>admin</option>-->

                      </select>


                      </div>
                  </div>

                  <div class="form-group has-warning">
                      <div class="col-sm-4 col-sm-offset-5">
                         <button class="btn btn-primary" type="submit" name="submit" >แก้ไขข้อมูล</button>
                      </div>
                 </div>


               </form>

<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {

                pass: {
                    ruleSD: "^[^'\"!@#$%&*()-+*/^., £กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ-]+$",
                    required: true,
                    minlength: 6,
                    maxlength: 10,

                },
                name: {
                    maxlength: 50,
                    required: true,
                    ruleSD: "^[^'\"]+$"

                },
                surname: {
                    maxlength: 50,
                    required: true,
                    ruleSD: "^[^'\"]+$"

                },
                address: {

                    required: true,
                    ruleSD: "^[^'\"]+$"

                },
                tel: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                    ruleSD: "^[^'\"]+$"

                },
                type: {
                    required: true,
                    ruleSD: "^[^'\"]+$"


                }

            }, messages: {

                pass: {
                    minlength: "กรุณากรอกข้อมูลอย่างน้อย 6 ตัวอักษร",
                    maxlength: "กรุณากรอกข้อมูลไม่เกิน 10 ตัวอักษร",
                    required: "กรุณากรอกรหัสผ่าน",
                    ruleSD: "กรุณากรอกตัวอักษรภาษาอังกฤษ ไม่สามารถใช้อักขระพิเศษได้"
                },
                name: {
                    maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                    required: "กรุณากรอกชื่อ",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                surname: {
                    maxlength: "กรุณาระบุไม่เกิน 50 ตัวอักษร",
                    required: "กรุณากรอกนามสกุล",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                address: {

                    required: "กรุณากรอกที่อยู่",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                tel: {
                    minlength: "กรุณากรอกเบอร์โทร 10 เลข",
                    maxlength: "กรุณากรอกเบอร์โทร 10 เลข",
                    required: "กรุณากรอกเบอร์โทร",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                },
                type: {

                    required: "กรุณาเลือกสิทธิ์การใช้งาน",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }

            }

        });
    });

</script>


