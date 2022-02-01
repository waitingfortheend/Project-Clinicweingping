<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");



@$diseaseid = $_POST['disease_id'];

@$sql_dis = mysqli_query($conn,"select * from diseasetype where diseasetypeid ='$diseaseid' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL


list($dis_id,$dis_name,$dis_detail,$pet_type) = mysqli_fetch_array($sql_dis);





?>




<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example ">
        <tr><th width="30%">รหัสโรค</th><td><?php echo $dis_id ?></td></tr>
        <tr><th width="10%">ชื่อโรค</th><td><?php echo $dis_name; ?></td></tr>
        <tr><th width="10%" >รายละเอียด</th><td style="text-align:justify"><?php echo $dis_detail; ?></td></tr>


        <?php

        $sql_pet = mysqli_query($conn,"select * from pet_type where pet_type ='$pet_type' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

        list($pet_id,$pet_name) = mysqli_fetch_array($sql_pet);

        ?>

        <tr><th width="10%">ประเภทสัตว์</th><td><?php echo $pet_name; ?></td></tr>

        <tr><th width="10%">อาการของโรค</th><td>
        <?php

        $sql_sym = mysqli_query($conn,"select sym_detail from symptoms where diseasetypeid ='$diseaseid' ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL
        $count = 1;
        while (list($sym_detail) = mysqli_fetch_array($sql_sym)){

            echo $count." ) ".$sym_detail."<br>";
            $count++;
        }

        ?>


    </td></tr>


    </table>
</div>