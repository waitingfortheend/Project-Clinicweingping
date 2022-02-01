<?php
include("include/connect_db.php");
$go = $_GET['type'];
if ($go == "1") {
    dog();
} elseif ($go == "disease") {
    disease();
} elseif ($go == "2") {
    cat();
}

function dog()
{

    $go = $_GET['type'];

    ?>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="ibox float-e-margins">


                    <form id="form">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr >
                                <th style="background-color: #afd9ee;text-align: center;" class="text-center">ลำดับ</th>
                                <th style="background-color: #afd9ee;text-align: center;"class="text-center">อาการ</th>
                                <th style="background-color: #afd9ee;text-align: center;" class="text-center">เลือก</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            include("include/connect_db.php");
                            $sql_type = mysqli_query($conn,"select * from pet_type WHERE pet_type ='$go'");
                            list($pet_type, $pet_name) = mysqli_fetch_array($sql_type);


                            ?>

                            <tr>
                                <td colspan="3" style="text-align: center;background-color: #ffffaa"><?php echo "การวินิจฉัยโรคเบื้องต้น " . $pet_name; ?></td>

                            </tr>

                            <?php


                            $sql_dis = mysqli_query($conn,"select diseasetypeid from diseasetype WHERE pet_type ='$go'");





                            while (list($dis_id) = mysqli_fetch_array($sql_dis)) {
                                $sql_sym = mysqli_query($conn,"select DISTINCT sym_detail from symptoms where diseasetypeid ='$dis_id'");

                                while (list($symdetail) = mysqli_fetch_array($sql_sym)) {

                                    $dis[] = $symdetail;

                                }

                            }

                            $num =1;

                            if (!empty($dis)) {


                                $count = count($dis);

                                for ($i = 0; $i < $count; $i++) {

                                    if (!empty($dis[$i])) {

                                        $newid = array_unique($dis);

                                        if(!empty($newid[$i])){
                                            echo " <tr class=\"gradeX\">";
                                            echo "<td>$num</td>";
                                            echo "<td>$newid[$i]</td>";
                                            echo "<td><input type='checkbox' class='big' name='diseasedetail[]' value='$newid[$i]'></td>";
                                            echo "</tr>";
                                            $num++;
                                        }


                                    }


                                }
                            }


                            ?>


                            </tbody>

                        </table>

                        <input type="reset" class="btn btn-Danger" id="reset" value="ล้าง" ">

                        <input type="button" class="btn btn-success" id="submit" value="วินิจฉัยเบื้องต้น" onclick="send('<?php echo $go; ?>')">

                    </form>

                </div>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
    </div>


    <?php
}

function cat()
{

    $go = $_GET['type'];

    ?>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="ibox float-e-margins">


                    <form id="form">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr >
                                <th style="background-color: #afd9ee;text-align: center;" class="text-center">ลำดับ</th>
                                <th style="background-color: #afd9ee;text-align: center;"class="text-center">อาการ</th>
                                <th style="background-color: #afd9ee;text-align: center;" class="text-center">เลือก</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sql_type = mysqli_query($conn,"select * from pet_type WHERE pet_type ='$go'");
                            list($pet_type, $pet_name) = mysqli_fetch_array($sql_type);


                            ?>

                            <tr>
                                <td colspan="3" style="text-align: center;background-color: #ffffaa"><?php echo "การวินิจฉัยโรคเบื้องต้น " . $pet_name; ?></td>

                            </tr>

                            <?php


                            $sql_dis = mysqli_query($conn,"select diseasetypeid from diseasetype WHERE pet_type ='$go'");





                            while (list($dis_id) = mysqli_fetch_array($sql_dis)) {
                                $sql_sym = mysqli_query($conn,"select DISTINCT sym_detail from symptoms where diseasetypeid ='$dis_id'");

                                while (list($symdetail) = mysqli_fetch_array($sql_sym)) {

                                    $dis[] = $symdetail;

                                }

                            }

                            $num =1;

                            if (!empty($dis)) {


                                $count = count($dis);

                                for ($i = 0; $i < $count; $i++) {

                                    if (!empty($dis[$i])) {

                                        $newid = array_unique($dis);

                                        if(!empty($newid[$i])){
                                            echo " <tr class=\"gradeX\">";
                                            echo "<td>$num</td>";
                                            echo "<td>$newid[$i]</td>";
                                            echo "<td><input type='checkbox' class='big' name='diseasedetail[]' value='$newid[$i]'></td>";
                                            echo "</tr>";
                                            $num++;
                                        }


                                    }


                                }
                            }


                            ?>


                            </tbody>

                        </table>

                        <input type="reset" class="btn btn-Danger" id="reset" value="ล้าง" ">

                        <input type="button" class="btn btn-success" id="submit" value="วินิจฉัยเบื้องต้น" onclick="send('<?php echo $go; ?>')">

                    </form>

                </div>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
    </div>
    <?php
}


function disease()
{

    include("include/connect_db.php");
    $pet_type = $_GET['pet_type'];

    if (!empty($_POST['diseasedetail'])) {


        $diseasedetail = $_POST['diseasedetail'];


        $count1 = count($diseasedetail);

        for ($i = 0; $i < $count1; $i++) {

            $sqldisease = mysqli_query($conn,"select  diseasetypeid from symptoms WHERE sym_detail = '$diseasedetail[$i]' ");

            while (list($diseasetypeid) = mysqli_fetch_array($sqldisease)) {

                $sqldisease2 = mysqli_query($conn,"select  * from diseasetype where  diseasetypeid = '$diseasetypeid' and pet_type = '$pet_type'  ");
                while (list($dis_id,$dis_name,$cure_dis,$pettype) = mysqli_fetch_array($sqldisease2)) {
                    $diseaseid[] = $dis_id;
                    $curedis[] = $cure_dis;
                    $disease[] = $dis_name;

                }


            }

        }
        $newid = array_unique($diseaseid);
        $resultid = array_filter($newid);





        $newdisease = array_unique($disease);
        $disease1 = array_filter($newdisease);


        $count2 = count($disease);
        echo "<div class=\"table-responsive\">";
        echo "<table class=\"table table-striped table-bordered table-hover dataTables-example\" >";
        echo "<tr about='' style='text-align: center;background-color: #F8D486;'> <th style='text-align: center;'>ชื่อโรค</th><th style='text-align: center;'>อาการของโรค</th><th style='text-align: center;'>รายละเอียด</th></tr>";

        $num=1;

        for ($i = 0; $i < $count2; $i++) {


            if (!empty($disease1[$i])){
                $sqlsym = mysqli_query($conn,"select sym_detail from symptoms where diseasetypeid = '$resultid[$i]'");

                echo "<tr class=\"gradeX\"><tbody></tr><td width='15%'>" .$num.") ". $disease1[$i] . "</td>";


                echo "<td width='40%'>";

                while (list($symdetail)= mysqli_fetch_array($sqlsym)){
                        echo $symdetail.",";
                }

                "</td>";


                $num++;
                echo "<td width='10%' align='center'><a class='btn btn-xs btn-info' href=\"#\" onClick=\"js_popup('dis_detail.php?sym_id=$diseaseid[$i]',783,600); return false;\" title=\"Code PHP Popup\">รายละเอียด</a></td> ";

            }


        }

    } else {
        echo "<script>alert('กรุณาเลือกอาการเพิ่มทำการวินิจฉัย')</script>";
    }


    echo "</table>";
    echo "</div>";



    ?>


    <?php


}

?>





<style>
    .big {
        width: 20px;
        height: 20px;

    }
</style>

<script src="js/plugins/dataTables/datatables.min.js"></script>



<script language="javascript">


   





    function js_popup(theURL,width,height) { //v2.0
        leftpos = (screen.availWidth - width) / 2;
        toppos = (screen.availHeight - height) / 2;
        window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
    }
</script>