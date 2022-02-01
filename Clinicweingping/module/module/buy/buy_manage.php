<?php
    check_type("Owner");

unset($_SESSION['sdrug_id']);
unset($_SESSION['drug_name_eng']);
unset($_SESSION['drug_price']);
unset($_SESSION['drug_amount']);

?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div align="left"><h5>จัดข้อมูลการซื้อ</h5></div>

                <div align="right">
                    <button type="button" class="btn btn-w-m btn-success"
                            ONCLICK=window.location.href='index.php?module=buy&action=buy_drug_manage&active=active9'><i
                            class="fa fa-plus"></i> | เพิ่มข้อมูลการซื้อ
                    </button>
                </div>

            </div>


            <div class="ibox-content">


                <!-- <center><button type="button" class="btn btn-w-m btn-success" ONCLICK=window.location.href='index.php?module=buy&action=insert_buy_form2'>เพิ่มข้อมูล2</button></center><br>
                -->

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th data-toggle="true">ลำดับที่</th>

                            <th>รหัสการซื้อ</th>
                            <th>วันที่ซื้อ</th>
                            <th>ราคารวม</th>
                            <th>รายละเอียด</th>
                            <th>สถานะการซื้อ</th>

                            <!-- <th>แก้ไข</th>-->
<!--                            <th>ลบ</th>-->


                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count = 1;

                            $sql_bd = mysqli_query($conn,"select * from buy_detail group by buy_id ORDER BY buy_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while (list($buy_id, $d_id, $b_price, $b_amount) = mysqli_fetch_array($sql_bd)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            $sql_buy = mysqli_query($conn,"select * from buy where buy_id='$buy_id' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                            list($b_id, $buy_date, $buy_total, $buy_status) = mysqli_fetch_array($sql_buy);

                            ?>
                            <td><?php echo $count++; ?></td>

                            <td>
                                <?php
                                echo $buy_id;
                                ?>
                            </td>

                            <?php
                            $b_date = explode(" ",$buy_date);
                            $bdate = explode("-",$b_date[0]);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $bdpet = $day."-".$month."-".$year." ".$b_date[1];

                            ?>

                            <td><?php echo $bdpet; ?></td>

                            <td><?php echo $buy_total . "\tบาท"; ?></td>

                            <td>
                                <div align="center">
                                    <button class="btn btn-xs btn-info"

                                            onclick="select_buy('<?php echo $buy_id; ?>');"


                                            data-toggle="modal" data-target="#myModal5"><i class="fa fa-search"></i> |
                                        รายละเอียด
                                    </button>
                                </div>
                            </td>

                            <?php
                            if ($buy_status == 0) {
                                ?>

                                <td>
                                    <div align="center">
                                        <?php

                                        echo "<a class=\"btn btn-xs btn-primary \" href='index.php?module=buy&action=update_buy&buy_id=$buy_id' onclick='return confirm(\"ยืนยันซื้อ $buy_id ?\")';>";
                                        ?>
                                        <i class="fa fa-check-circle"></i> | รอการยืนยันการซื้อ</a>
                                    </div>
                                </td>

                                <?php

                            } else {
                                ?>
                                <td>
                                    <div align="center">
                                        <?php

                                        echo "<a class=\"btn btn-xs btn-warning \" >";
                                        ?>
                                        <i class="fa fa-check-circle"></i> |  ยืนยันการซื้อเรียบร้อยแล้ว</a>
                                    </div>
                                </td>

                                <?php


                            }


                            ?>


<!--                            <td>-->
<!--                                <div align="center">-->
<!--                                    --><?php
//
//                                    echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=buy&action=delete_buy&buy_id=$buy_id' onclick='return confirm(\"คุณลบข้อมูล $buy_id ?\")';>";
//                                    ?>
<!--                                    <i class="fa fa-minus-square"></i> | ลบ</a>-->
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

                <h3>รายละเอียดการซื้อ</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_buy"></div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-success dim" onClick=printDiv("divprint")><i class="fa fa-print"></i> |
                    พิมพ์
                </button>

                <button type="button" id="form1cacle" class="btn btn-danger btn-sm dim"
                        data-dismiss="modal"><i class="fa fa-close"></i>
                    | ปิดหน้าต่าง
                </button>
                <!--                                 <button type="button" class="btn btn-primary">Save changes-->
                <!--                                 </button>-->
            </div>
        </div>
    </div>
</div>


<script>
    $('.dataTables-example').DataTable({});


    function select_buy(buy_id) {


        $.ajax({

            type: "POST",
            url: "module/buy/detail_buy.php",
            data: {buyid: buy_id},
            success: function (data) {
                $("#select_buy").html(data);

            },
            error: function () {
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
        window.location.href = "index.php?module=buy&action=buy_manage&active=active9";

    }


</script>


