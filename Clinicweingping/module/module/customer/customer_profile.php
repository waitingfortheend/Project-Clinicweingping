<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Employee" and  $_SESSION['login_type']!="Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");

?>
<?php
@$cus_id = $_REQUEST['cus_id'];

@$_SESSION['customer'] = $cus_id;


@$sql_cus = mysqli_query($conn,"select * FROM customer WHERE cus_id ='$cus_id'") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
list($cus_id, $cus_name, $cus_surname, $cus_address, $cus_telephone) = mysqli_fetch_array($sql_cus);

$sql_count = mysqli_query($conn,"select count(pet_id) from pet where cus_id='$cus_id'") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
list($count) = mysqli_fetch_array($sql_count);


?>

<div  id="divprint">
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover dataTables-example">


        <tr>
            <th>
                <?php echo "ชือ " . $cus_name . " นามสกุล " . $cus_surname; ?>
            </th>
            <!--                <th>-->
            <!--                    --><?php //echo "สัตว์เลี้ยง ". $count . " ตัว "; ?>
            <!--                </th>-->
        </tr>

        <tr>
            <td>
                <?php echo "รหัสลูกค้า : " . $cus_id ?>
            </td>
            <!--                <td>-->
            <!---->
            <!--                </td>-->
        </tr>
        <tr>
            <td>

                <?php echo "ที่อยู่ : " . $cus_address ?>
            </td>
<!--            <td>-->
<!---->
<!--            </td>-->

        </tr>

        <tr>
            <td><?php echo "เบอร์โทร : " . $cus_telephone ?></td>
<!--            <td>-->
<!---->
<!--            </td>-->

        </tr>

    </table>
</div>





<div class="col-md-3">
    <small></small>
    <h2 class="no-margins"></h2>
    <div id="sparkline1"></div>
</div>




<div class="row" >
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            
            <div class="ibox-title" >
               <h5>
                    <?php echo "สัตว์เลี้ยง ". $count . " ตัว "; ?>
                </h5>

            </div>


            <div class="ibox-content">


<!--                <input type="text" class="form-control input-sm m-b-xs" id="filter"-->
<!--                       placeholder="Search in table">-->

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example"
                           data-filter=#filter>
                        <thead>
                        <tr>

                                            <th colspan="7">
                                               ข้อมูลสัตว์
                                            </th>
                        </tr>
                        <tr>
                            <th data-toggle="true">รหัสสัตว์</th>
                            <th>ชื่อสัตว์</th>
                            <th data-hide="phone,tablet">ประเภท</th>
                            <th data-hide="phone,tablet">พันธุ์</th>

                            <th data-hide="phone,tablet">เพศ</th>
                            <th data-hide="phone,tablet">วันเกิด</th>

                            <th data-hide="phone,tablet">รูปภาพ</th>


                        </tr>

                        </thead>
                        <tbody>

                        <tr class="gradeU">
                            <?php


                            $sql_pet = mysqli_query($conn,"select * from pet where cus_id='" . $cus_id . "' order by pet_id DESC") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


                            while (list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                            ?>

                            <td><?php echo $pet_id; ?></td>
                            <td><?php echo $pet_name; ?></td>

                            <?php
                            $pettype = mysqli_query($conn,"select * from pet_type where pet_type = $pet_type");
                            list($sql_type_id_2, $type_name_2) = mysqli_fetch_array($pettype);

                            ?>

                            <td><?php echo $type_name_2; ?></td>



                            <td><?php echo $pet_species; ?></td>
                            <td><?php
                                if ($pet_sex == "M") {
                                    $pet_sex = "เพศผู้";
                                } else {
                                    $pet_sex = "เพศเมีย";
                                }

                                echo $pet_sex; ?></td>





                            <?php

                            $bdate = explode("-",$pet_age);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $bdpet = $day."-".$month."-".$year;

                            ?>
                            <td><?php echo $bdpet; ?></td>

                            <td>

                                <?php
                                if (empty($pet_picture)) {
                                    $pet_picture = "no-d.jpg";

                                }
                                ?>

                                <?php
                                echo "<img alt='image' width='60px' height='35px' class='img-rectangle' src='images/$pet_picture'>";
                                ?>
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
</div>


<div>


    <div class="form-group">
        <?php  if($_SESSION['login_type']!="Veterinary"){ ?>
    <button class="btn btn-outline btn-info  dim "
            ONCLICK=window.location.href="index.php?module=service&action=service_pet_manage&active=active12&cus_id=<?php echo $_SESSION['customer']; ?>"><i
            class="fa fa-pencil-square-o"></i> เพิ่มข้อมูลการบริการ</button>
        <?php  } ?>

        <?php  if($_SESSION['login_type']!="Employee"){ ?>
        <button class="btn btn-outline btn-danger  dim"
            ONCLICK=window.location.href="index.php?module=treatment&action=treatment_pet_manage&active=active13&cus_id=<?php echo $_SESSION['customer']; ?>"><i
            class="fa fa-medkit"></i> เพิ่มข้อมูลการรักษา</button>

        <?php  } ?>


    </div>