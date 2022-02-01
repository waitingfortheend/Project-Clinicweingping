<?php

check_type("Veterinary");


?>

<?php

if (empty($_GET['cus_id'])) {
    $customer = "";
    $condition = "";
} else {
    $customer = $_GET['cus_id'];
    $condition = "WHERE cus_id LIKE '$customer' ";
    $_SESSION['search_pet'] = $condition;
    $_SESSION['customer'] = $_GET['cus_id'];
    

}
if (empty($_SESSION['search_pet'])) {
    $SESSION['search_pet'] = "";
} else {

    $condition = $_SESSION['search_pet'];
}

?>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>เพิ่มข้อมูลการรักษา
                    <?php
                    if(!empty($_SESSION['customer'])){

                        echo "ลูกค้า ".$_SESSION['customer'];
                    }

                    ?>

                </h5>


            </div>


            <div class="ibox-content">
                <form method="post" action="index.php?module=treatment&action=">


                    <center>
                        <button type="button" class="btn btn-w-m btn-danger"
                                ONCLICK=window.location.href='index.php?module=treatment&action=clear_session'>
                            ค้นหาทั้งหมด
                        </button>
                    </center>



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>


                                <th >รหัสสัตว์</th>
                                <th >รหัสลูกค้า</th>
                                <th>ชื่อสัตว์</th>
                                <th >ประเภท</th>
                                <th >พันธุ์</th>
                                <th >วันเกิด</th>
                                <th >เพศ</th>
                                <th >รูปภาพ</th>
                                <th>เลือก</th>

                            </tr>

                            </thead>
                            <tbody>

                            <tr class="gradeU">
                                <?php
                                $count = 1;



                                $chk_in = '';
                                if (empty($_GET['chk_in'])) {
                                    $chk = '';

                                    $val = 1;
                                    $color = 'white';

                                } else {
                                    $chk = 'checked';//ให้ติ๊ก checkbox
                                    $val = '';//กำหนดค่าที่ส่งจากตัวแปร $_GET['chk_del']
                                    $color = '#D5EAFF';

                                }





                                $sql_drug = mysqli_query($conn,"select * from pet  $condition  order by pet_id DESC  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                while (list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_drug)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                                $sql_type =mysqli_query($conn,"select * from pet_type where pet_type = $pet_type");
                                list($sql_type_id,$type_name)=mysqli_fetch_array($sql_type);
                                ?>


                                <td>
                                    <?php
                                    echo $pet_id;
                                    ?>
                                </td>
                                <td><?php echo $cus_id; ?></td>
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
                                <td><?php echo $bdpet; ?>  </td>

                                <td><?php
                                    if ($pet_sex == "M") {
                                        $pet_sex = "เพศผู้";
                                    } else {
                                        $pet_sex = "เพศเมีย";
                                    }

                                    echo $pet_sex; ?></td>

                                <td>
                                    <?php
                                    if (empty($pet_picture)) {
                                        $pet_picture = "no-d.jpg";

                                    }

                                    echo "<img alt='image' width='60px' heigh='20px' class='img-rectangle' src='images/$pet_picture'>";
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-w-m btn-info"
                                            ONCLICK=window.location.href='index.php?module=treatment&action=insert_treatment_form&active=active13&pet_id=<?php echo $pet_id ?>'>
                                        เพิ่มข้อมูลการรักษา
                                    </button>
                                </td>


                            </tr>

                            <?php }
                            echo "</form>   "; ?>


                            </tbody>


                           
                        </table>


                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('.dataTables-example').DataTable({


    });

</script>