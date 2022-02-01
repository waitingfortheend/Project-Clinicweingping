<?php

include("include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');
?>

<div class="row">
    <div class="col-sm-12 text-center">
     

        <form>
            <h1>ระบบวินิจฉัยโรคเบื้องต้น</h1>


            <?php $sql_type = mysqli_query($conn,"select * from pet_type WHERE pet_type ='1' or pet_type='2'");
            $i = 0;
            while (list($sql_type_id, $type_name) = mysqli_fetch_array($sql_type)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                $r = "r";
                $r .= $i;

                ?>

                <input id="<?php echo $r; ?>" name="radio" class="big" type="radio"
                       value="<?php echo $sql_type_id; ?>" name="a"
                       onchange="showform('<?php echo $sql_type_id; ?>');"><?php echo $type_name; ?> &nbsp;&nbsp;

                <?php $i++;
            } ?>



            <p>
            <div id="results"></div>
            <div id="output"></div>

            </p>


        </form>

        <div id="results"></div>


        </div>

</div>