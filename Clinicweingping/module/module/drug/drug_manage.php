<?php

check_type("Veterinary");


?>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div align="left"><h5>จัดการข้อมูลยา</h5></div>

                <div align="right">
                    <button type="button" class="btn btn-sm btn-success"
                            onclick="insert_form();"
                            data-toggle="modal" data-target="#myModal1">
                        <i class="fa fa-flask"></i> | เพิ่มข้อมูลยา
                    </button>
                </div>


                <div class="ibox-content">


                    <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสยา</th>
                                <th>ชื่อยา(Eng)</th>
                                <th>ชื่อยา(TH)</th>
                                <!--                                     <th>รายละเอียด</th>-->
                                <th>ราคา</th>
                                <th>ราคาขาย</th>
                                <th>จำนวน</th>
                                <th>หน่วยนับ</th>
                                <!--                                     <th>วันผลิต (MFG)</th>-->
                                <!--                                     <th>วันหมด (EXP)</th>-->
                                <th>รูปภาพ</th>
                                <!--                                     <th>ประเภทยา</th>-->
                                <th>รายละเอียด</th>
                                <th>แก้ไข</th>
<!--                                <th>ลบ</th>-->


                            </tr>

                            </thead>
                            <tbody>

                            <tr class="gradeU">
                                <?php
                                $count = 1;

                                $sql_drug = mysqli_query($conn,"select * from drug ORDER BY d_id DESC ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                while (list($d_id, $d_eng, $d_th, $d_detail, $d_price, $s_price, $amount, $unit, $mfg, $exp, $picture, $type) = mysqli_fetch_array($sql_drug)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                                ?>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <?php
                                    echo $d_id;
                                    ?>
                                </td>
                                <td><?php echo $d_eng; ?></td>
                                <td><?php echo $d_th; ?></td>
                                <td><?php echo $d_price; ?></td>
                                <td><?php echo $s_price; ?></td>

                                <td><?php echo $amount; ?></td>
                                <td><?php echo $unit; ?></td>
                                <td>


                                    <?php

                                    if (empty($picture)) {
                                        $picture = "no-pd.jpg";

                                    }
                                    echo "<img alt='image' width='50px' heigh='30px' class='img-rectangle' src='images/$picture'>";
                                    ?>
                                </td>

                                <?php

                                $sql_type = mysqli_query($conn,"select * from type_drug where type_d_id = $type");
                                list($type_id, $type_name) = mysqli_fetch_array($sql_type)
                                ?>


                                <!--                     <td>--><?php //echo $type_name;
                                ?><!--</td>-->

                                <td>
                                    <div align="center">
                                        <button class="btn btn-xs btn-info"
                                                value="ดูรายละเอียด"
                                                onclick="select_drug('<?php echo $d_id; ?>');"
                                                data-toggle="modal" data-target="#myModal5">
                                            <i class="fa fa-search"></i> | รายละเอียด
                                    </div>
                                </td>


                                </button>
                                <td>


                                    <div align="center">
                                        <button type="button" class="btn btn-xs btn-warning"
                                                onclick="edit_drug('<?php echo $d_id; ?>');"

                                                data-toggle="modal" data-target="#myModal6">
                                            <i class="fa fa-cogs"></i> | แก้ไขข้อมูล
                                        </button>


                                    </div>

                                </td>

<!--                                <td>-->
<!--                                    --><?php
//
//                                    echo "<a  class=\"btn btn-xs btn-danger\" href='index.php?module=drug&action=delete_drug&active=active7&d_id=$d_id' onclick='return confirm(\"คุณลบข้อมูล $d_id ?\")';>";
//                                    ?>
<!--                                    <i class="fa fa-minus-square"></i> | ลบ-->
<!--                                    </a>-->
<!---->
<!--                                </td>-->
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


<div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h2>รายละเอียดยา</h2>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_drug"></div>

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

                <h2>แก้ไขข้อมูลยา</h2>
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

                <h3>เพิ่มข้อมูลยา</h3>
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
            url: "module/drug/insert_drug_form.php",
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

    function select_drug(drug_id) {


        $.ajax({

            type: "POST",
            url: "module/drug/drug_detail.php",
            data: {d_id: drug_id},
            success: function (data) {
                $("#select_drug").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }


    function edit_drug(drug_id) {


        $.ajax({

            type: "POST",
            url: "module/drug/edit_drug_form.php",
            data: {d_id: drug_id},
            success: function (data) {
                $("#edit_drug").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }


</script>