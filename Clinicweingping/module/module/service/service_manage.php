<?php

check_type("Employee");


unset($_SESSION['spet_id']);
unset($_SESSION['spet_name']);
unset($_SESSION['sdetail']);
unset($_SESSION['price']);
unset($_SESSION['scus_id']);
unset($_SESSION['search_pet']);
unset($_SESSION['customer']);

?>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div align="left"><h5>จัดการข้อมูลการบริการ</h5></div>


                <div align="right"><button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=service&action=service_pet_manage&active=active12'>
                        <i class="fa fa-plus"></i> | เพิ่มข้อมูลการบริการ
                    </button></div>

            </div>
            <div class="ibox-content">


                <br>



                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th data-toggle="true">ลำดับที่</th>

                            <th >รหัสบริการ</th>
                            <th>วันที่</th>
                            <th>ราคารวม</th>

                            <th>รายละเอียด</th>

<!--                            <th>ลบ</th>-->

                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count = 1;

                            $sql_service = mysqli_query($conn,"select * from service group by ser_id ORDER BY ser_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while (list($ser_id, $ser_date, $ser_total) = mysqli_fetch_array($sql_service)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            $sql_sdetail = mysqli_query($conn,"select * from service_detail where ser_id='$ser_id'  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                            list($ser_id, $ser_detail, $pet_id) = mysqli_fetch_array($sql_sdetail)
                            ?>

                            <td>
                                <?php
                                echo $count++;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $ser_id;
                                ?>
                            </td>



                            <?php
                            $s_date = explode(" ",$ser_date);
                            $bdate = explode("-",$s_date[0]);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $s_date = $day."-".$month."-".$year . " " . $s_date[1];

                            ?>

                            <td><?php echo $s_date; ?></td>
                            <td><?php echo $ser_total . "\tบาท"; ?></td>

                            <td><div align="center"><button

                                       onclick="select_ser('<?php echo $ser_id; ?>');"

                                       class="btn btn-xs btn-info"
                                       data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search"></i> | รายละเอียด</button></div></td>


<!--                            <td>-->
<!--                                <div align="center">-->
<!--                                  --><?php
//
//                                        echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=service&action=delete_service&ser_id=$ser_id' onclick='return confirm(\"คุณลบข้อมูล $ser_id ?\")';>";
//                                        ?>
<!--                                <i class="fa fa-minus-square"></i> | ลบ-->
<!--                                        </a>-->
<!--                                </div>-->
<!--                            </td>-->


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
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>รายละเอียดการบริการ</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_ser"></div>

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
    $('.dataTables-example').DataTable({


    });



    function select_ser(ser_id) {

        $.ajax({

            type:"POST",
            url:"module/service/service_detail.php",
            data:{serid:ser_id},
            success:function (data) {
                $("#select_ser").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=service&action=service_manage&active=active11";

    }


</script>
