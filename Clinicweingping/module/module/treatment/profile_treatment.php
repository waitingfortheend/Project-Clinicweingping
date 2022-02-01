<?php

if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>ข้อมูลการรักษา</h5>



            </div>
            <div class="ibox-content">


                <br>



                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th data-toggle="true">ลำดับที่</th>

<!--                            <th >รหัสการรักษา</th>-->
                            <th>รหัสสัตว์</th>

                            <th>ชื่อสัตว์</th>
                            <th>ประเภทสัตว์</th>
                            <th>พันธุ์สัตว์</th>
                            <th>วันเกิด</th>

                            <!--                            <th>ค่ารักษา</th>-->
                            <th>เพศ</th>
                            <th>รูปภาพ</th>
                            <th>ประวัติการรักษา</th>

                            <!--                            <th data-hide="all">ชื่อสัตว์</th>-->
                            <!--                            <th data-hide="all">ประเภท</th>-->
                            <!--                            <th data-hide="all">พันธ์ุ</th>-->
                            <!--                            <th data-hide="all">อายุ</th>-->
                            <!--                            <th data-hide="all">เพศ</th>-->
                            <!--                            <th data-hide="all">รูปภาพ</th>-->

                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php
                            $count = 1;

                            $sql_service = mysqli_query($conn,"select * from treatment group by pet_id ORDER BY pet_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            while (list($treat_id, $pet_id, $treat_date, $examination, $sick, $judge, $cash_total) = mysqli_fetch_array($sql_service)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            $sql_pet = mysqli_query($conn,"select * from pet where pet_id=$pet_id") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                            list($pet_id2, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);
                            $sql_type =mysqli_query($conn,"select * from pet_type where pet_type = $pet_type");
                            list($sql_type_id,$type_name)=mysqli_fetch_array($sql_type);

                            ?>
                            <td><?php echo $count;  ?></td>

                            <td><?php echo $pet_id;  ?></td>
                            <td><?php echo $pet_name; ?></td>


                            <td><?php echo $type_name; ?></td>
                            <td><?php echo $pet_species; ?></td>

                            <?php

                            $bdate = explode("-",$pet_age);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $bdpet = $day."-".$month."-".$year;

                            ?>

                            <td><?php echo $bdpet; ?></td>

                            <td><?php
                                if($pet_sex=="M"){
                                    $pet_sex="เพศผู้";
                                }else{
                                    $pet_sex="เพศเมีย";
                                }

                                echo $pet_sex; ?></td>

                            <?php



                            ?>

                            <td>
                                <?php
                                if(empty($pet_picture)){
                                    $pet_picture="no-d.jpg";

                                }

                                echo "<img alt='image' width='60px' height='35px' class='img-rectangle' src='images/$pet_picture'>";
                                ?>
                            <!--                            <td>--><?php //echo $cash_total . "\tบาท"; ?><!--</td>-->
                            <td><div align="center"><button
                                        onclick="select_tre('<?php echo $pet_id; ?>');"

                                        class="btn btn-xs btn-info"
                                        data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search"></i> | ประวัติการรักษา</button></div></td>





                        </tr>

                        <?php
                        $count++;
                        } ?>

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
            url:"module/treatment/profile_detail.php",
            data:{pet_id:treat_id},
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
        window.location.href = "index.php?module=treatment&action=profile_treatment&active=active27";

    }

</script>