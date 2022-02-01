<?php

check_type("Veterinary");


?>

<?php


include ("../include/connect_db.php");

$sql_treat = mysqli_query($conn,"Select  Max(substr(treat_id,-6))+1 as treat_id from treatment") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

while ($row = mysqli_fetch_assoc($sql_treat))
{
//    echo $row['treat_id'];
   $new_id =  $row['treat_id'];
   if ($new_id == 0) { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
    $t_id = "T000001";
    } else {
        $t_id = "T" . sprintf("%06d", $new_id);//ถ้าไม่ใช่ค่าว่าง
    }



}

/*
while (list($treat_id) = mysqli_fetch_array($sql_treat)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

    $result = mysqli_query($conn,"Select  Max(substr(treat_id,-6))+1 as treat_id from treatment");
 

    printf($result);
    
    // $new_id = mysqli_result($result, 0, "treat_id");//เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย


    if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
        $t_id = "T000001";
    } else {
        $t_id = "T" . sprintf("%06d", $new_id);//ถ้าไม่ใช่ค่าว่าง
    }

}
*/

unset($_SESSION['sdrug_id']);
unset($_SESSION['drug_name_eng']);
unset($_SESSION['drug_price']);
unset($_SESSION['drug_amount']);
unset($_SESSION['treat_exa']);
unset($_SESSION['treat_sick']);
unset($_SESSION['treat_judge']);
unset($_SESSION['treat_price']);
unset($_SESSION['p_id']);
unset($_SESSION['t_id']);
unset($_SESSION['all']);
unset($_SESSION['unit']);
unset($_SESSION['chkapp']);
unset($_SESSION['app']);
unset($_SESSION['app_detail']);
unset($_SESSION['time']);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <h5>เพิ่มข้อมูลการรักษา</h5>

            </div>

            <div class="ibox-content">
                <form id="form" role="form" method="post"
                      action="index.php?module=treatment&action=insert_treatment&active=active13" class="wizard-big">
                    <h1>ข้อมูลการรักษา</h1>
                    <fieldset>
                        <h1>การรักษา</h1>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>รหัสการรักษา</label>
                                    <input id="userName" name="treat_id" disabled="true" value="<?php echo $t_id; ?>"
                                           type="text" class="form-control required">
                                </div>

                                <div class="form-group">
                                    <label>รหัสสัตว์</label>
                                    <input id="" name="pet_id" disabled="true" value="<?php echo $_GET['pet_id']; ?>"
                                           type="text" class="form-control required">
                                </div>
                                <?php $sql_pet = mysqli_query($conn,"select * from pet where pet_id=$_GET[pet_id]  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                list($pet_id, $pet_name, $pet_type, $pet_species, $pet_age, $pet_sex, $pet_picture, $cus_id) = mysqli_fetch_array($sql_pet);

                                ?>


                                <input id="" name="p_id" value="<?php echo $_GET['pet_id']; ?>" type="hidden">
                                <input id="" name="t_id" value="<?php echo $t_id; ?>" type="hidden">


                                <?php
                                $today = date("m/d/Y");


                                ?>


                                <div class="form-group">
                                    <label>การตรวจร่างกาย *</label>

                                    <textarea name="treat_exa"
                                              class="form-control required"></textarea>

                                </div>


                                <div class="form-group">

                                    <label>อาการ *</label>
                                    <textarea name="treat_sick"
                                              class="form-control required"></textarea>

                                </div>
                                <div class="form-group">

                                    <label>วินิจฉัยโรค *</label>
                                    <textarea name="treat_judge"
                                              class="form-control required"></textarea>

                                </div>
                                <div class="form-group">
                                    <label>ค่ารักษา *</label>
                                    <input name="treat_price"  type="text"
                                           class="form-control required">
                                </div>


                            </div>
                            <div class="col-lg-6">


                                <div class="form-group">
                                    <label>ชื่อสัตว์</label>
                                    <input id="" name="pet_name" disabled="true" value="<?php echo $pet_name; ?>"
                                           type="text" class="form-control required">
                                </div>

                                <div class="form-group">

                                    <?php
                                    if (empty($pet_picture)) {
                                        $pet_picture = "no-d.jpg";

                                    }

                                    echo "<center><img alt='image' width='300px' height='300px' class='img-rectangle' src='images/$pet_picture'></center>";
                                    ?>

                                </div>


                    </fieldset>

                    <h1>การนัดหมาย</h1>
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>การนัดหมาย</h1>


                                <div class="form-group">
                                    <label> <input type="checkbox" id="checkBox" class="big" name="chkapp" value="1" >
                                        มีการนัด </label>
                                </div>


                                <div class="form-group">
                                    <label>วันนัดหมาย</label><br>
                                    <div id="well">
                                        <div class="col-md-7">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span><input type="text"
                                                                                                 id="datepicker"
                                                                                                 class="form-control"
                                                                                                 name="app"
                                                                                                 data-role="date"

                                                                                                 value="<?php echo $today ?>" disabled>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="input-group clockpicker" data-placement="top" data-align="top"
                                         data-autoclose="true">
                                        <input type="text" name="time" id="time" class="form-control" disabled   value="09:00">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>



                                <script type="text/javascript">
                                    $('.datepicker').datepicker()
                                    $('.clockpicker').clockpicker();


                                </script>


                                <div class="form-group">

                                    <br><label>รายละเอียดการนัด</label>
                                    <textarea id="appdetail" name="app_detail" style="height: 100px"
                                              class="form-control" disabled></textarea>

                                </div>


                            </div>
                            <br/>


                        </div>

                    </fieldset>

                    <!--                    <h1>เสร็จสิ้น</h1>-->
                    <!--                    <fieldset>-->
                    <!---->
                    <!--                        <h2>ยืนยันการรักษา</h2>-->
                    <!--                        <!--                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="i-checks required"> <label-->

                    <!--                        <!--                            for="acceptTerms">ยืนยัน</label>-->
                    <!---->
                    <!--                    </fieldset>-->


                </form>


            </div>

        </div>

    </div>


</div>


<style>
    .big {
        width: 20px;
        height: 20px;
    }
</style>


<script>



    jQuery(document).ready(function () {

        var chk=0 ;
        $("#checkBox").click(function () {

            if(chk==0){
                $('#appdetail').attr('disabled',false);
                $('#datepicker').attr('disabled',false);
                $('#time').attr('disabled',false);

                chk++;
            }else {

                $('#appdetail').attr('disabled',true);
                $('#datepicker').attr('disabled',true);
                $('#time').attr('disabled',true);

                chk--;
            }



        });
    });





    $("#form").validate({
        rules: {
            treat_exa: {
                required: true,
                ruleSD: "^[^'\"]+$"

            }, treat_sick: {
                required: true,
                ruleSD: "^[^'\"]+$"

            },treat_judge: {
                required: true,
                ruleSD: "^[^'\"]+$"

            }, treat_price: {
                required: true,
                ruleSD: "^[^'\"]+$",
                number:true,
                range: [1,1000000],

            }, app_detail:{
                required: true,
                ruleSD: "^[^'\"]+$",
 

            }, app:{
                required: true,


            }, time:{
                required: true,


            }

        }, messages: {
            treat_exa: {

                required: "กรุณากรอกข้อมูลการตรวจร่างกาย",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }, treat_sick: {

                required: "กรุณากรอกข้อมูลอาการ",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }, treat_judge: {

                required: "กรุณากรอกข้อมูลการวินิจฉัยโรค",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }, treat_price: {

                required: "กรุณากรอกค่ารักษา",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",
                range: "กรุณากรอกราคาให้ถูกต้อง"
            },  app_detail: {
                required: "กรุณากรอกรายละเอียดการนัด",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute",

            },  app: {
                required: "กรุณาเลือกวันที่นัดหมาย",

            },  time: {
                required: "กรุณาเลือกวันที่นัดหมาย",

            }


        }


    });

</script>




<script type="text/javascript">




    $(function () {



        $("#datepicker").datepicker({dateFormat: "dd-mm-yy"}).val()


    });


</script>