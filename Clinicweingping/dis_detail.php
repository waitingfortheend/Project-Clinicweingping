<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- Animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
<meta charset="utf-8">

<?php
include("include/connect_db.php");

$sym_id = $_GET['sym_id'];


$sqldisease = mysqli_query($conn,"select  * from diseasetype WHERE diseasetypeid = '$sym_id' ");

list($diseaseid, $name, $cure, $pet_type) = mysqli_fetch_array($sqldisease);

//echo $id."<br>";
//echo $name."<br>";
//echo $cure."<br>";
//echo $pet_type."<br>";


?>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">


                <form id="form">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th  style="text-align: center;background-color:#87cefa;">วินิจฉัยเบื้อต้น <?php echo $name; ?></th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <th style="text-align: center;background-color: #ffffaa;">อาการ</th>
                        </tr>
                        <tr>
                            <td style="padding-left: 40%;background-color: lightgoldenrodyellow;">
                                <?php $sqlsym = mysqli_query($conn,"select sym_detail from symptoms where diseasetypeid = '$diseaseid'");
                                    $count =1;
                                while (list($symdetail) = mysqli_fetch_array($sqlsym)) {

                                    echo $count++.") ".$symdetail."<br>";

                                }


                                ?>

                            </td>
                        </tr>
                        <tr>


                            <th style="text-align: center;background-color: #ffffaa;">
                                คำแนะนำ
                            </th>

                        </tr>
                        <tr>
                            <td style="text-align:justify">

                                <?php $sqldis = mysqli_query($conn,"select curedisease from diseasetype where diseasetypeid = '$diseaseid'");

                                list($cure) = mysqli_fetch_array($sqldis);

                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cure."<br>";



                                ?>

                            </td>

                        </tr>


                        </tbody>
                        <tfoot></tfoot>
                    </table>
                        </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
</div>
