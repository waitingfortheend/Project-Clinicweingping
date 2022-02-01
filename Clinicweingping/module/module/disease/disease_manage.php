<?php

check_type("Veterinary");


?>

<div id="wrapper">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>จัดการข้อมูลวินิจฉัยโรค</h5>
                        <div align="right">
                            <button type="button" class="btn btn-sm btn-success"
                                    onclick="insert_form();"
                                    data-toggle="modal" data-target="#myModal1">
                                <i class="fa fa-pagelines"></i> | เพิ่มข้อมูลโรค
                            </button>
                            <button type="button" class="btn btn-sm btn-success"
                                    onclick="insert_sym();"
                                    data-toggle="modal" data-target="#myModal2">
                                <i class="fa fa-stethoscope"></i> | เพิ่มอาการของโรค
                            </button>

                        </div>

                    </div>


                    <div class="ibox-content">


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>


                                    <th>รหัสโรค</th>
                                    <th>ชื่อโรค</th>
                                    <th>ประเภทสัตว์</th>
                                    <th>รายละเอียด</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>


                                </tr>

                                </thead>
                                <tbody>




                                <?php
                                $sql_disease = mysqli_query($conn,"select * from diseasetype  ");
                                while (list($disease_id, $disease_name, $disease_cure, $pet_type) = mysqli_fetch_array($sql_disease)) {
                                    $pettype = mysqli_query($conn,"select * from pet_type WHERE pet_type = '$pet_type'");
                                    list($pet_type2, $pet_type_name) = mysqli_fetch_array($pettype) or die(mysql_error());
                                ?>

                                <tr class="gradeU">

                                    <td><?php echo $disease_id; ?>
                                    </td>
                                    <td><?php echo $disease_name; ?>
                                    </td>
                                    <td><?php echo $pet_type_name; ?>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <button class="btn btn-xs btn-info"
                                                    value="ดูรายละเอียด"
                                                    onclick="select_dis('<?php echo $disease_id; ?>');"
                                                    data-toggle="modal" data-target="#myModal5">
                                                <i class="fa fa-search"></i> | รายละเอียด
                                        </div>

                                    </td>
                                    <td>
                                        <div align="center">
                                            <button type="button" class="btn btn-xs btn-warning"
                                                    onclick="edit_drug('<?php echo $disease_id; ?>');"

                                                    data-toggle="modal" data-target="#myModal6">
                                                <i class="fa fa-cogs"></i> | แก้ไขข้อมูล
                                            </button>


                                        </div>

                                    </td>
                                    <td>

                                        <?php

                                        echo "<a  class=\"btn btn-xs btn-danger\" href='index.php?module=disease&action=delete_disease&active=active26&diseasetypeid=$disease_id' onclick='return confirm(\"คุณลบข้อมูล $disease_id ?\")';>";
                                        ?>
                                        <i class="fa fa-minus-square"></i> | ลบ
                                        </a>

                                    </td>
                                </tr>



                                <?php     } ?>
                                </tbody>


                            </table>

                        </div>
                    </div>
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

                <h2>รายละเอียดการวินิจฉัยโรค</h2>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_dis"></div>

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



<div class="modal inmodal" id="myModal6" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h2>แก้ไขข้อมูลโรค</h2>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="edit_drug"></div>

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

                <h2>เพิ่มข้อมูลการวินิจฉัยโรค</h2>
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




<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h2>เพิ่มข้อมูลอาการโรค</h2>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="insert_sym"></div>

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

    function insert_sym() {


        $.ajax({

            type: "POST",
            url: "module/disease/insert_sym_form.php",
            success: function (data) {
                $("#insert_sym").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }
    function insert_form() {


        $.ajax({

            type: "POST",
            url: "module/disease/insert_disease_form.php",
            success: function (data) {
                $("#insert_form").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }
    function select_dis(disease) {


        $.ajax({

            type: "POST",
            url: "module/disease/disease_detail.php",
            data: {disease_id: disease},
            success: function (data) {
                $("#select_dis").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }

    function edit_drug(disease) {


        $.ajax({

            type: "POST",
            url: "module/disease/edit_disease_form.php",
            data: {disease_id: disease},
            success: function (data) {
                $("#edit_drug").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }

    $('.dataTables-example').DataTable({});

</script>



