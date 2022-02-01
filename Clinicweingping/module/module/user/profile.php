<?php
@session_start();
if (empty($_SESSION['valid_user'])) {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

@$user = $_SESSION['valid_user'];
?>


<?php
@$sql = mysqli_query($conn,"select * from user where user_name='$user'") or die(mysql_error());
list($user_name, $password, $type_id) = mysqli_fetch_array($sql);
@$sql_emp = mysqli_query($conn,"select * from employee where user_name='$user'") or die(mysql_error());
list($emp_id, $emp_name, $emp_surname, $emp_address, $emp_telephone, $emp_user) = mysqli_fetch_array($sql_emp);

?>
<br>
<div class="row">
    <div class="col-lg-2">
        </div>
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>ข้อมูลผู้ใช้</h5>


            </div>
            <div class="ibox-content">

                <tr class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">


                        <tr><th>ชื่อผู้ใช้</th><th><?php echo $user_name;  ?></th></tr>
                        <tr><th>รหัสผ่าน</th><td><?php echo "****** &nbsp;&nbsp;";  ?><button type="button" class="btn btn-xs btn-warning"
                                                                                 onclick="edit_user('<?php echo $user_name; ?>');"
                                                                                 data-toggle="modal" data-target="#myModal5">
                                    <i class="fa fa-cogs"></i> | แก้ไขรหัสผ่าน
                                </button></td></tr>
                        <tr><th>สิทธิ์ผู้ใช้งาน</th><td><?php echo $type_id;  ?></td></tr>
                        <tr><th>ชื่อ-สกุล</th><td><?php echo $emp_name."&nbsp; " .$emp_surname;  ?></td></tr>
                        <tr><th>ที่อยู่</th><td><?php echo $emp_address;  ?></td></tr>
                        <tr><th>เบอร์โทรศัพท์</th><td><?php echo $emp_telephone;  ?></td></tr>

                    </table>

                    </div>







                </div>
            </div>
        </div>
    </div>

<div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>แก้ไขรหัสผ่าน</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="edit_user"></div>

            </div>

            <div class="modal-footer">
                <button type="button" id="form1cacle" class="btn btn-danger btn-sm  dim"
                        data-dismiss="modal">
                    <i class="fa fa-close"></i>
                    | ปิดหน้าต่าง
                </button>
                <!--                                 <button type="button" class="btn btn-primary">Save changes-->
                <!--                                 </button>-->
            </div>
        </div>
    </div>
</div>

<script>
    function edit_user(user) {


        $.ajax({
            type: "POST",
            url: "module/user/edit_password.php",
            data: {user_name: user},
            success: function (data) {
                $("#edit_user").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }


</script>