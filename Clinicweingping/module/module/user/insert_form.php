<?php
if (empty($_SESSION['valid_user'])) {
    session_start();
}
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Owner") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

?>


<form role="form" id="form" method="post" action="index.php?module=user&action=insert_user" class="form-horizontal">

    <div class="form-group"><label class="col-sm-3 control-label ">Username</label>
        <div class="col-sm-7"><input type="text" name="user" required
                                     placeholder="Username"
                                     class="form-control"></div>
    </div>
    <div class="form-group"><label class="col-sm-3 control-label">Password</label>

        <div class="col-sm-7"><input type="password"  name="pass" required
                                     placeholder="Password"
                                     class="form-control"
                                     name="password"></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">ชื่อ</label>
        <div class="col-sm-7"><input type="text"  name="name" required
                                     placeholder="Name"
                                     class="form-control"></div>
    </div>
    <div class="form-group"><label class="col-sm-3 control-label">นามสกุล</label>
        <div class="col-sm-7"><input type="text"  name="surname" required
                                     placeholder="Surname"
                                     class="form-control"></div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">ที่อยู่</label>
        <div class="col-sm-7"><textarea name="address" required placeholder="Address" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group"><label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
        <div class="col-sm-7">
            <!-- <input type="text" name="tel" placeholder="Telephone" class="form-control" required="">  -->
            <input type="text" name="tel" placeholder="Telephone" required class="form-control" class="form-control">

        </div>
    </div>


    <div class="form-group"><label class="col-sm-3 control-label">สิทธิ์การใช้</label>

        <div class="col-sm-5"><select name="type" required class="form-control m-b">
                <option value="">กรุณาเลือก</option>
                <option>Employee</option>
                <option>Veterinary</option>
                <!--                          <option>Admin</option>-->

            </select>


        </div>
    </div>


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
                user: {
                    ruleSD: "^[^'\"!@#$%&*()-+*/^., £กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ-]+$",
                    required: true,
                    minlength: 6,
                    maxlength: 10,

                },
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
                user: {
                    minlength: "กรุณากรอกข้อมูลอย่างน้อย 6 ตัวอักษร",
                    maxlength: "กรุณากรอกข้อมูลไม่เกิน 10 ตัวอักษร",
                    required: "กรุณากรอกชื่อผู้ใช้",
                    ruleSD: "กรุณากรอกตัวอักษรภาษาอังกฤษ ไม่สามารถใช้อักขระพิเศษได้"
                },
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


