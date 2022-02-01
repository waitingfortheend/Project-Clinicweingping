<?php

if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

unset($_SESSION['sdrug_id']);
unset($_SESSION['drug_name_eng']);
unset($_SESSION['drug_price']);
unset($_SESSION['drug_amount']);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div align="left"><h5>ข้อมูลการขายยา</h5></div>



                <div align="right"><button type="button" class="btn btn-w-m btn-success" ONCLICK=window.location.href='index.php?module=dispensation&action=dispensation_drug_manage&active=active16'>
                        <i class="fa fa-plus"></i> |  เพิ่มข้อมูลการขายยา</button></div>

            </div>



            <div class="ibox-content">


                <!-- <center><button type="button" class="btn btn-w-m btn-success" ONCLICK=window.location.href='index.php?module=buy&action=insert_buy_form2'>เพิ่มข้อมูล2</button></center><br>
                -->


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr >
                            <td data-toggle="true" >ลำดับที่</td>
                            <th >รหัสการขายยา</th>
                            <th>วันที่</th>
                            <th>ราคารวม</th>
                            <th>รายละเอียด</th>

                            <!-- <th>แก้ไข</th>-->
<!--                            <th>ลบ</th>-->


                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count =1;
                            $alltotal[]=array();
                            $sql_dispensation = mysqli_query($conn,"select treat_drug_id,d_id,amount,sum(total) as total,t_date from treatment_drug group by treat_drug_id ORDER BY treat_drug_id Desc")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while(list($treat_drug_id,$d_id,$amount,$total,$t_date)=mysqli_fetch_array($sql_dispensation)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                            ?>

                            <td >
                                <?php
                                echo $count++;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $treat_drug_id;
                                ?>
                            </td>


                            <?php
                            $tr_date = explode(" ",$t_date);
                            $bdate = explode("-",$tr_date[0]);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $treat_date = $day."-".$month."-".$year . " " . $tr_date[1];

                            ?>

                            <td><?php echo $treat_date;  ?></td>

                            <td><?php echo $total."\tบาท";  ?></td>

                            <td><div align="center"><button

                                       onclick="select_dis('<?php echo $treat_drug_id; ?>');"

                                       class="btn btn-info btn-xs"
                                       data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search"></i> | รายละเอียด</button></div></td>

<!--                            <td>-->
<!---->
<!--                                <div align="center">-->
<!--                                --><?php
//
//                                        echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=dispensation&action=delete_dispensation&treat_drug_id=$treat_drug_id' onclick='return confirm(\"คุณลบข้อมูล $treat_drug_id ?\")';>";
//                                        ?>
<!--                                    <i class="fa fa-minus-square"></i> |  ลบ-->
<!--                                       </a>-->
<!--                                </div>-->
<!---->
<!---->
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

                <h3>รายละเอียดการขายยา</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="select_dis"></div>

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

    $('.dataTables-example').DataTable({


    });

    function select_dis(treat_d_id) {

        $.ajax({

            type:"POST",
            url:"module/dispensation/dispensation_detail.php",
            data:{treat_drug_id:treat_d_id},
            success:function (data) {
                $("#select_dis").html(data);

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
        window.location.href = "index.php?module=dispensation&action=dispensation_manage&active=active15";

    }

</script>