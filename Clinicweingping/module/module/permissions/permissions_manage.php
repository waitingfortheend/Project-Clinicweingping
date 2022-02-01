<?php

check_type("Admin");


?>



<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>จัดการสิทธิ์ผู้ใช้</h5>

            </div>
            <div class="ibox-content">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>ชื่อผู้ใช้</th>
                            <th>รหัสผ่าน</th>
                            <th>สิทธิ์ผู้ใช้งาน</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>




                        </tr>

                        </thead>
                        <tbody>

                        <?php
                        $count =1;

                        $user=mysqli_query($conn,"select user_name,password,type_id from user WHERE type_id != 'admin'")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                        while(list($user_name,$password,$type_id)=mysqli_fetch_array($user)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                        ?>
                        <tr class="gradeU">


                            <td><?php echo $user_name; ?></td>
                            <td><?php echo $password;  ?></td>
                            <td><?php echo $type_id; ?></td>





                            <td> <div align="center"><button type="button" class="btn btn-xs btn-warning"
                                                             onclick="edit_user('<?php echo $user_name; ?>');"
                                                             data-toggle="modal" data-target="#myModal5">
                                        <i class="fa fa-cogs"></i> | แก้ไขข้อมูล</button>

                                    </button>
                                </div>

                            </td>
                            <td>
                                <?php

                                echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=permissions&action=delete_permissions&user_name=$user_name' onclick='return confirm(\"คุณลบข้อมูล $user_name ?\")';>";
                                ?>
                                <i class="fa fa-minus-square"></i> | ลบ
                                </a>
                            </td>




                            <?php } ?>


                        </tbody>


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

                <h3>แก้ไขสิทธิ์ผู้ใช้งาน</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="edit_user"></div>

            </div>

            <div class="modal-footer">
                <button type="button" id="form1cacle" class="btn btn-danger btn-sm dim"
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

            type:"POST",
            url:"module/permissions/permissions_edit.php",
            data:{user_name:user},
            success:function (data) {
                $("#edit_user").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }


    $('.dataTables-example').DataTable({


    });

</script>