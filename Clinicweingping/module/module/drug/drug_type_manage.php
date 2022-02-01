<?php

check_type("Veterinary");


?>

<div id="wrapper">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>จัดการข้อมูลประเภทยา</h5>
                        <div align="right">
                            <button type="button" class="btn btn-sm btn-success"
                                    onclick="insert_form();"
                                    data-toggle="modal" data-target="#myModal1">
                                <i class="fa fa-flask"></i> | เพิ่มข้อมูลประเภทยา
                            </button>
                        </div>

                    </div>


                    <div class="ibox-content">


                        <div class="table-responsive">

                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th data-toggle="true">ลำดับที่</th>

                                    <th>รหัสประเภทยา</th>
                                    <th>ชื่อประเภทยา</th>
                                    <th>แก้ไข</th>
<!--                                    <th>ลบ</th>-->


                                </tr>

                                </thead>
                                <tbody>

                                <tr class="gradeU">
                                    <?php
                                    $count = 1;

                                    $sql_tdrug = mysqli_query($conn,"select * from type_drug  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                    while (list($type_d_id, $type_d_name) = mysqli_fetch_array($sql_tdrug)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                                    ?>

                                    <td><?php echo $count++; ?></td>

                                    <td><?php echo $type_d_id; ?></td>
                                    <td><?php echo $type_d_name; ?></td>


                                    <td>


                                        <div align="center">
                                            <button type="button" class="btn btn-xs btn-warning"
                                                    onclick="edit_typedrug('<?php echo $type_d_id; ?>');"

                                                    data-toggle="modal" data-target="#myModal6">
                                                <i class="fa fa-cogs"></i> | แก้ไขข้อมูล
                                            </button>


                                        </div>

                                    </td>


                                </tr>

                                <?php } ?>


                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal inmodal" id="myModal6" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>แก้ไขข้อมูลประเภทยา</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="modal-body">

                <div id="edit_typedrug"></div>

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

<div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>เพิ่มข้อมูลประเภทยา</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="insert_form"></div>

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
    function insert_form() {


        $.ajax({

            type: "POST",
            url: "module/drug/insert_type_form.php",
            success: function (data) {
                $("#insert_form").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }

    $('.dataTables-example').DataTable({});


    function edit_typedrug(drug_id) {


        $.ajax({

            type: "POST",
            url: "module/drug/edit_type_form.php",
            data: {type_d_id: drug_id},
            success: function (data) {
                $("#edit_typedrug").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }

</script>
