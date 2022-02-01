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
                <h5>เพิ่มข้อมูลการขายยา</h5>

               
            </div>



            <div class="ibox-content">

                <form   method="post" action="index.php?module=dispensation&action=add2dis&active=active16">

                    <center><button type="button" class="btn btn-w-m btn-info" ONCLICK=window.location.href='index.php?module=dispensation&action=show_cart&active=active16'>รายการขายยา</button></center><br>



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th data-toggle="true">เลือก</th>
                                <th>รหัสยา</th>
                                <th>ชื่อยา(Eng)</th>
                                <th>ชื่อยา(TH)</th>
                                <th>รายละเอียด</th>
                                <th>ราคา</th>
                                <th>ราคาขาย</th>
                                <th>จำนวน</th>

                                <th>วันผลิต (MFG)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>วันหมด (EXP)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>รูปภาพ</th>
                                <th>ประเภทยา</th>



                            </tr>

                            </thead>
                            <tbody>

                            <tr class="gradeU">


                                <?php
                                $count =1;

                                $chk_in='';
                                if(empty($_GET['chk_in'])){
                                    $chk='';

                                    $val=1;
                                    $color='white';

                                }else{
                                    $chk='checked';//ให้ติ๊ก checkbox
                                    $val='';//กำหนดค่าที่ส่งจากตัวแปร $_GET['chk_del']
                                    $color='#D5EAFF';

                                }



                                $check = " ";
                                if(!empty($_SESSION['sdrug_id']) and $_SESSION['sdrug_id']){

                                    $cnt = count($_SESSION['sdrug_id']);
                                    for($i=0;$i<$cnt;$i++){

                                        $check .= " and d_id  != '".$_SESSION['sdrug_id'][$i]."'";

                                    }

                                }

                                


                                $sql_drug = mysqli_query($conn,"select * from drug where amount >0 $check  ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                                
                                while(list($d_id,$d_eng,$d_th,$d_detail,$d_price,$s_price,$amount,$unit,$mfg,$exp,$picture,$type)=mysqli_fetch_array($sql_drug)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว


                                ?>

                                <td>
                                    <div class='i-checks'>

                                        <input  name="drug[]" <?php echo $chk; ?>  type="checkbox"  value="<?php echo $d_id ?>">
                                    </div>

                                </td>

                                <td>
                                    <?php echo $d_id;  ?>
                                </td>
                                <td><?php echo $d_eng;  ?></td>
                                <td><?php echo $d_th; ?></td>
                                <td><?php echo $d_detail; ?></td>
                                <td><?php echo $d_price; ?></td>
                                <td><?php echo $s_price; ?></td>

                                <td><?php echo $amount. " ". $unit; ?></td>
                               



                                <?php

                                $bdate = explode("-",$mfg);
                                $year = $bdate[0];
                                $month = $bdate[1];
                                $day = $bdate[2];

                                $mfg_date = $day."-".$month."-".$year ;


                                $bdate = explode("-",$exp);
                                $year = $bdate[0];
                                $month = $bdate[1];
                                $day = $bdate[2];

                                $exp_date = $day."-".$month."-".$year ;

                                ?>

                                <td><?php echo $mfg_date; ?></td>
                                <td><?php echo $exp_date; ?></td>
                                <td>
                                    <?php

                                    if(empty($picture)){
                                        $picture="no-pd.jpg";

                                    }
                                    echo "<img alt='image' width='60px' heigh='20px' class='img-rectangle' src='images/$picture'>";
                                    ?>
                                </td>

                                <?php

                                $sql_type = mysqli_query($conn,"select * from type_drug where type_d_id = $type");
                                list($type_id,$type_name)=mysqli_fetch_array($sql_type)
                                ?>

                                <td><?php echo $type_name; ?></td>

                                <?php

                                ?>


                            </tr>

                            <?php }


                            ?>

                            </tbody>


                            <tfoot>

                            <tr>
                                <?php
                                echo"
                                    <td colspan='5'> <button  class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=dispensation&action=dispensation_drug_manage&active=active16&chk_in=$val'><i class='fa fa-check'></i>
                                    </button></td>";

                                echo "<td colspan='2'><button type='submit' class='btn btn-w-m btn-success'>เพิ่มข้อมูลการขายยา</button>";
                                echo "</td></form>";

                                ?>

                                <td colspan="6">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>


                            </tfoot>
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