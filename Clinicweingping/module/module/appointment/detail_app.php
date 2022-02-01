<?php
include ("../../include/connect_db.php");

$app_date1 = $_POST['app_date'];



$sql_app = mysqli_query($conn,"select * from appointment where app_date ='$app_date1' ");

list($app_id,$pet_id,$app_date,$app_detail) = mysqli_fetch_array($sql_app) or die(mysql_error());

$sql_pet = mysqli_query($conn,"select cus_id from pet where pet_id = '$pet_id' ");

list($cus_id) = mysqli_fetch_array($sql_pet) or die(mysql_error());

$sql_cus = mysqli_query($conn,"select * from customer where cus_id = '$cus_id' ");

list($cus_id2,$cus_name,$cus_surname,$cus_add,$cus_tel) = mysqli_fetch_array($sql_cus) or die(mysql_error());

?>


<div  id="divprint">

                <h3>การนัดหมาย</h3>
                <?php
                $today = date("d-m-Y");
                ?>
                 <h5>รหัสการนัด <?php  echo $app_id;  ?></h5>


                 <h5>วันที่ออกใบนัด <?php  echo $today;  ?></h5>
                <h5>รหัสลูกค้า <?php  echo $cus_id2;  ?> </h5>
                <h5>ชื่อลูกค้า <?php  echo $cus_name." ".$cus_surname;  ?> </h5>
                <h5>เบอร์โทรศัพท์ <?php  echo $cus_tel  ?> </h5>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>รหัสสัตว์</th>
                            <th>วันที่ทำการนัด</th>
                            <th>รายละเอียดการนัด</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <?php echo $pet_id;  ?>
                            </td>

                            <?php
                            $date = explode(" ",$app_date);
                            $bdate = explode("-",$date[0]);
                            $year = $bdate[0];
                            $month = $bdate[1];
                            $day = $bdate[2];

                            $appdate = $day."-".$month."-".$year . " " . $date[1];

                            ?>


                            <td>
                                <?php echo $appdate;  ?>
                            </td>


                            <td>
                                <?php echo $app_detail;  ?>
                            </td>


                        </tr>




                        </tbody>


                    </table>
                </div>

        

</div>
<script>


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = "index.php?module=appointment&action=app_manage&active=active24";

    }

</script>