<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}


@include ("../../include/connect_db.php");

?>





             <?php
             @$sql_cus =mysqli_query($conn,"select * from customer where cus_id='$_POST[cus_id]'")or die(mysql_error());
             list($cus_id,$cus_name,$cus_surname,$cus_address,$cus_telephone)=mysqli_fetch_array($sql_cus);

            ?>


               <form role="form" id="form" method="post" action="index.php?module=customer&action=update_customer" class="form-horizontal">


                   <div class="form-group "><label class="col-sm-3 control-label ">รหัสลูกค้า</label>
                       <div class="col-sm-8">

                           <input type="text" name="1" disabled placeholder="" class="form-control"  value="<?php echo $cus_id?>">

                       </div>
                   </div>
                       <div class="form-group "><label class="col-sm-3 control-label ">ชื่อ</label>
                       <div class="col-sm-8">

                           <input type="text" name="cus_name" placeholder="" class="form-control"  value="<?php echo $cus_name?>">

                       </div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label" required="" value="<?php echo $cus_surname?>">นามสกุล</label>

                       <div class="col-sm-8"><input type="text" name="cus_surname"  placeholder="" class="form-control"  value="<?php echo $cus_surname?>"></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">ที่อยู่</label>
                       <div class="col-sm-8"><textarea name="cus_address" placeholder="" class="form-control"  ><?php echo $cus_address ?></textarea></div>
                  </div>

                  <div class="form-group "><label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
                       <div class="col-sm-8">

                          <input type="text" name="cus_telephone" placeholder="Telephone" class="form-control"  value="<?php echo $cus_telephone ?>">

                       </div>
                  </div>

                  <input type="hidden" name="cus_id" placeholder="" class="form-control"  value="<?php echo $cus_id ?>">



                  <div class="form-group ">
                      <div class="col-sm-4 col-sm-offset-5">
<!--                          <button class="btn btn-white"  type="button" onclick="window.location='index.php?module=customer&action=customer_manage&active=active3'">ยกเลิก</button>-->
                          <button class="btn btn-primary" type="submit" name="submit" >แก้ไข</button>
                      </div>
                 </div>

          
               </form>
<script>
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