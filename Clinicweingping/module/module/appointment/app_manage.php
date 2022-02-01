<?php


if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}


?>


<div id="wrapper">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>ข้อมูลการนัด</h5>


                    </div>



                    <div class="ibox-content">



                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th >ลำดับ</th>

                                <th>รหัสการนัด</th>

                                <th >รหัสสัตว์</th>
                                <th>วันที่นัดหมาย</th>
                                <th>รายละเอียดการนัด</th>
                                <th>พิมพ์ใบนัด</th>
<!--                                <th>ลบ</th>-->


                            </tr>

                            </thead>
                            <tbody>

                            <tr class="gradeU">
                                <?php
                                $count =1;

                                $app = mysqli_query($conn,"select * from appointment order by app_id DESC  ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                while(list($app_id,$pet_id,$app_date,$app_detail)=mysqli_fetch_array($app)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                                ?>
                                <td><?php echo $count++; ?></td>


                                <td><?php echo $app_id; ?></td>

                                <td><?php echo $pet_id; ?></td>
                                
                                <?php
                                $date = explode(" ",$app_date);
                                $bdate = explode("-",$date[0]);
                                $year = $bdate[0];
                                $month = $bdate[1];
                                $day = $bdate[2];

                                $appdate = $day."-".$month."-".$year . " " . $date[1];

                                ?>
                                
                                <td><?php echo $appdate;  ?></td>

                                <td><?php echo $app_detail;  ?></td>






                                <td>



                                    <div align="center">
                                        <button type="button" class="btn btn-xs btn-warning"
                                                onclick="detail_app('<?php echo $app_date; ?>');"

                                                data-toggle="modal" data-target="#myModal6">
                                            <i class="fa fa-print"></i> | พิมพ์ใบนัด
                                        </button>


                                    </div>

                                </td>

<!--                                <td>-->
<!---->
<!--                                            --><?php
//
//                                            echo "<a class=\"btn btn-xs btn-danger\" href='index.php?module=appointment&action=delete_app&active=active24&app_date=$app_date' onclick='return confirm(\"คุณลบข้อมูล รหัสสัตว์ $pet_id  รายละเอียด $app_detail วันที่ $app_date ?\")';>";
//                                            ?>
<!--                                            <i class="fa fa-minus-square"></i> | ลบ-->
<!--                                            </i></a>-->
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



<div class="modal inmodal" id="myModal6" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>รายละเอียดการนัด</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"><span
                        aria-hidden="true"></button>
            </div>

            <div class="modal-body">

                <div id="detail_app"></div>

            </div>



            <div class="modal-footer">
                <button class="btn btn-success dim" onClick=printDiv("divprint")><i class="fa fa-print"></i> |
                    พิมพ์
                </button>
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

    $('.dataTables-example').DataTable({


    });


    function detail_app(app_date) {


        $.ajax({

            type:"POST",
            url:"module/appointment/detail_app.php",
            data:{app_date:app_date},
            success:function (data) {
                $("#detail_app").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }

</script>
