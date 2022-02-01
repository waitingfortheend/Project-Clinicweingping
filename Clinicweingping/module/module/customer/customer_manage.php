<?php

check_type("Employee");


?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>จัดการข้อมูลลูกค้า</h5>

                <div align="right">
                    <button type="button" class="btn btn-sm btn-success "
                            onclick="insert_form();"
                            data-toggle="modal" data-target="#myModal1">
                        <i class="fa fa-user-plus"></i> | เพิ่มข้อลูกค้า
                    </button>


                </div>

            </div>
            <div class="ibox-content">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>ลำดับที่</th>

                            <th>รหัสลูกค้า</th>
                            <th>ชื่อลูกค้า</th>
                            <th>นามสกุล</th>
                            <th>ที่อยู่</th>
                            <th>เบอร์โทร</th>
                            <th>แก้ไข</th>
<!--                            <th>ลบ</th>-->
                            <th>ข้อมูลสัตว์</th>


                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count = 1;

                            $sql_cus = mysqli_query($conn,"select cus_id,cus_name,cus_surname,cus_address,cus_telephone from customer ORDER  by cus_id DESC") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while (list($cus_id, $cus_name, $cus_surname, $cus_address, $cus_telephone) = mysqli_fetch_array($sql_cus)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                            ?>

                            <td><?php echo $count++; ?></td>

                            <td><?php echo $cus_id; ?></td>
                            <td><?php echo $cus_name; ?></td>
                            <td><?php echo $cus_surname; ?></td>
                            <td width="25%"><?php echo $cus_address; ?></td>
                            <td width="10%"><?php echo $cus_telephone; ?></td>


                            <td>
                                <div align="center">
                                    <button type="button" class="btn btn-xs btn-warning"
                                            onclick="edit_cus('<?php echo $cus_id; ?>');"

                                            data-toggle="modal" data-target="#myModal5">
                                        <i class="fa fa-cogs"></i> | แก้ไขข้อมูล
                                    </button>


                                </div>

                            </td>

<!--                            <td>-->
<!--                                --><?php
//
//                                echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=customer&action=delete_customer&cus_id=$cus_id' onclick='return confirm(\"คุณลบข้อมูล $cus_name ?\")';>";
//                                ?>
<!--                                <i class="fa fa-minus-square"></i> | ลบ</a>-->
<!---->
<!--                            </td>-->

                            <td>
                                <div align="center">
                                    <button type="button" class="btn btn-xs btn-info"
                                            onclick="cus_pro('<?php echo $cus_id; ?>');"

                                            data-toggle="modal" data-target="#myModal6">
                                        <i class="fa fa-github-square"></i> | ข้อมูลสัตว์
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


<div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>แก้ไขข้อมูลลูกค้า</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="edit_cus"></div>

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
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>ข้อมูลเจ้าของสัตว์</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="cus_pro"></div>

            </div>

            <div class="modal-footer">


                <button class="btn btn-info dim" onClick=insert_pet()><i class="fa fa-plus"></i> |<span
                        class="bold"></span>
                    เพิ่มข้อมูลสัตว์เลี้ยง
                </button>

                <button class="btn btn-success dim" onClick=printDiv("divprint")><i class="fa fa-print"></i> |<span
                        class="bold">Print</span>
                    พิมพ์
                </button>
                <button type="button" id="form1cacle" class="btn btn-danger btn-sm dim"
                        data-dismiss="modal">
                    <i class="fa fa-close"></i>
                    | ปิดหน้าต่าง
                </button>


            </div>
        </div>
    </div>
</div>


<div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>เพิ่มข้อมูลลูกค้า</h3>
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




<div class="modal inmodal" id="myModal11" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>เพิ่มข้อมูลลูกค้า</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="insert_form_pet"></div>

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
            url: "module/customer/insert_customer_form.php",
            success: function (data) {
                $("#insert_form").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }



        function insert_pet() {
            $('#myModal6').modal('hide')
            $('#myModal11').modal('show')

            $.ajax({

                type: "POST",
                url: "module/pet/insert_pet_form.php",
                success: function (data) {
                    $("#insert_form_pet").html(data);

                },
                error: function () {
                    alert("error");
                }


            });
            return false;

        }




    $('.dataTables-example').DataTable({});
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=customer&action=customer_manage&active=active3";

    }

    function edit_cus(cus) {


        $.ajax({

            type: "POST",
            url: "module/customer/edit_customer_form.php",
            data: {cus_id: cus},
            success: function (data) {
                $("#edit_cus").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }


    function cus_pro(cus) {


        $.ajax({

            type: "POST",
            url: "module/customer/customer_profile.php",
            data: {cus_id: cus},
            success: function (data) {
                $("#cus_pro").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }


</script>
