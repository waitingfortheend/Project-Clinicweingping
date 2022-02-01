<?php

if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}

?>

<?php

      $sql_count = mysqli_query($conn,"select count(pet_id) from pet ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL
      list($count)=mysqli_fetch_array($sql_count);




?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                        <div class="ibox-title">
                             <h5>จัดการข้อมูลสัตว์</h5>
                            <div align="right">
                                <button type="button" class="btn btn-sm btn-success"
                                        onclick="insert_form();"
                                        data-toggle="modal" data-target="#myModal1">
                                    <i class="fa fa-user-plus"></i> | เพิ่มข้อมูลสัตว์เลี้ยง
                                </button>


                            </div>

                        </div>



                        <div class="ibox-content">



                              <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover dataTables-example">
                                 <thead>
                                 <tr>
                                     <th data-toggle="true">ลำดับที่</th>

                                     <th >รหัสสัตว์</th>
                                     <th>ชื่อสัตว์</th>
                                     <th>ประเภท</th>
                                     <th>พันธุ์</th>
                                     <th>วันที่เกิด</th>
                                     <th>เพศ</th>
                                     <th>รูปภาพ</th>
                                     <th>แก้ไข</th>
<!--                                     <th>ลบ</th>-->
                                     <th>ข้อมูลลูกค้า</th>

                                 </tr>

                                 </thead>
                                 <tbody>

                                <tr class="gradeU">
                     <?php


                           $sql_pet =mysqli_query($conn,"select * from pet ORDER BY pet_id DESC  ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                     $count1 =1;
                           while(list($pet_id,$pet_name,$pet_type,$pet_species,$pet_age,$pet_sex,$pet_picture,$cus_id)=mysqli_fetch_array($sql_pet)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว
                     $sql_type =mysqli_query($conn,"select * from pet_type where pet_type = $pet_type");
                         list($sql_type_id,$type_name)=mysqli_fetch_array($sql_type);

                        ?>
                                    <td><?php echo $count1++;  ?></td>
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
                     </td>

                                    <td> <div align="center"><button type="button" class="btn btn-xs btn-warning"
                                                                     onclick="edit_pet('<?php echo $pet_id; ?>');"
                                                                     data-toggle="modal" data-target="#myModal5">
                                                <i class="fa fa-cogs"></i> | แก้ไขข้อมูล</button>

                                            </button>
                                        </div>

                                    </td>
                                    

<!--                     <td>-->
<!---->
<!--                           --><?php
//
//                           echo "<a class=\"btn btn-xs btn-danger\"  href='index.php?module=pet&action=delete_pet&pet_id=$pet_id' onclick='return confirm(\"คุณลบข้อมูล $pet_id ?\")';>";
//                           ?>
<!--                            <i class="fa fa-minus-square"></i> | ลบ</a>-->
<!---->
<!--                     </td>-->


                     <td>
                         <button type="button" class="btn btn-xs btn-info"
                                 onclick="cus_pro('<?php echo $cus_id; ?>');"

                                 data-toggle="modal" data-target="#myModal6">
                             <i class="fa fa-user-plus"></i> | ข้อมูลลูกค้า
                         </button>
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

                <h3>แก้ไขข้อมูลสัตว์</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="edit_pet"></div>

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
                        id="form1cacle"><span
                        aria-hidden="true"></button>
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
                <!--                                 <button type="button" class="btn btn-primary">Save changes-->
                <!--                                 </button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>เพิ่มข้อมูลสัตว์เลี้ยง</h3>
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
            url: "module/pet/insert_pet_form.php",
            success: function (data) {
                $("#insert_form").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;
    }

    $('.dataTables-example').DataTable({


    });

    function insert_pet() {

        $('#myModal6').modal('hide')
        $('#myModal1').modal('show')

        $.ajax({

            type: "POST",
            url: "module/pet/insert_pet_form.php",
            success: function (data) {
                $("#insert_form").html(data);

            },
            error: function () {
                alert("error");
            }


        });
        return false;


    }
    function edit_pet(pet) {


        $.ajax({

            type:"POST",
            url:"module/pet/edit_pet_form.php",
            data:{pet_id:pet},
            success:function (data) {
                $("#edit_pet").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }


    function cus_pro(cus) {


        $.ajax({

            type:"POST",
            url:"module/customer/customer_profile.php",
            data:{cus_id:cus},
            success:function (data) {
                $("#cus_pro").html(data);

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
        window.location.href = "index.php?module=pet&action=pet_manage&active=active5";

    }
</script>