<?php

check_type("Veterinary");


?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>จัดการข้อมูลการรักษา</h5>

                <div align="right">
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=treatment&action=treatment_pet_manage&active=active13'>
                        <i class="fa fa-plus"></i> | เพิ่มข้อมูลการรักษา
                    </button>
               </div>

            </div>
            <div class="ibox-content">


                <br>



                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th data-toggle="true">ลำดับที่</th>

                            <th >รหัสการรักษา</th>
                            <th>รหัสสัตว์</th>
                            <th>วันที่รักษา</th>
                            <th>การตรวจร่างกาย</th>
                            <th>อาการ</th>
                            <th>วินิจฉัย</th>
<!--                            <th width="9%">ค่ารักษา</th>-->
                            <th width="9%">รหัสการขายยา</th>

                            <th>รายละเอียด</th>
<!--                            <th>ลบ</th>-->


                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count = 1;

                            $sql_service = mysqli_query($conn,"select * from treatment group by treat_id ORDER BY treat_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while (list($treat_id, $pet_id, $treat_date, $examination, $sick, $judge, $cash_total,$treat_drug) = mysqli_fetch_array($sql_service)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            $sql_pet = mysqli_query($conn,"select * from pet where pet_id=$pet_id") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            list($pet_id2, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);

                            ?>

                            <td><?php echo $count++; ?></td>

                            <td>
                                <?php
                                echo $treat_id;
                                ?>
                            </td>

                            <td><?php echo $pet_id; ?></td>


                            <?php
                            $t_date = explode(" ",$treat_date);
                            $bdate = explode("-",$t_date[0]);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $tre_date = $day."-".$month."-".$year . " " . $t_date[1];

                            ?>

                            <td><?php echo $tre_date; ?></td>



                            <td><?php echo $examination; ?></td>
                            <td><?php echo $sick; ?></td>
                            <td><?php echo $judge; ?></td>
<!--                            <td>--><?php //echo $cash_total . "\tบาท"; ?><!--</td>-->
                            <td><?php echo $treat_drug; ?></td>

                            <td><div align="center"><button
                                                           onclick="select_tre('<?php echo $treat_id; ?>');"

                                                           class="btn btn-xs btn-info"
                                                           data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search"></i> | รายละเอียด</button></div></td>

<!--                            <td>-->
<!---->
<!--                                <div align="center">-->
<!--                                        --><?php
//
//                                        echo "<a <a class=\"btn btn-xs btn-danger\" href='index.php?module=treatment&action=delete_treatment&treat_id=$treat_id' onclick='return confirm(\"คุณลบข้อมูล $treat_id ?\")';>";
//                                        ?>
<!--                                <i class="fa fa-minus-square"></i> | ลบ-->
<!--                                       </a>-->
<!--                                    </div>-->
<!---->
<!---->
<!--                            </td>-->



                        </tr>

                        <?php }

                        unset($_SESSION['customer']);
                        unset($_SESSION['search_pet']);
                        ?>

                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>รายละเอียดการรักษา</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_tre"></div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success dim" onClick=printDiv("divprint")><i class="fa fa-print"></i> |
                    พิมพ์
                </button>
                <button type="button" id="form1cacle" class="btn btn-danger btn-sm dim"
                        data-dismiss="modal"><i class="fa fa-close"></i>
                    |  ปิดหน้าต่าง
                </button>
                <!--                                 <button type="button" class="btn btn-primary">Save changes-->
                <!--                                 </button>-->
            </div>
        </div>
    </div>
</div>


<script>


    function select_tre(treat_id) {

        $.ajax({

            type:"POST",
            url:"module/treatment/treatment_detail.php",
            data:{treat_id:treat_id},
            success:function (data) {
                $("#select_tre").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }

    $('.dataTables-example').DataTable({


    });


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=treatment&action=treatment_manage&active=active13";

    }

</script>