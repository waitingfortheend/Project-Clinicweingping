<?php


   $buy_date = date("Y-m-d H:s:i");
      $b_id = $_POST["b_id"];
      $b_amount =   $_POST["b_amount"];
      $b_price =   $_POST["b_price"];
      $d_id =   $_POST["d_id"];




?>



<div class="row">
   <div class="col-lg-10">
        <div class="ibox float-e-margins">
           <div class="ibox-title">
               <h5>ยืนยันการบันทึกการซื้อ<small></small></h5>
               <div class="ibox-tools">

                   <a class="close-link">
                       <i class="fa fa-times"></i>
                   </a>
               </div>
           </div>


           <div class="ibox-content">
               <form  method="post" action="index.php?module=buy&action=insert_buy" class="form-horizontal" enctype="multipart/form-data">




                  <?php

                  $sql_drug = mysqli_query($conn,"select * from drug  ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL
                  ?>

                <div class="form-group has-warning"><label class="col-sm-2 control-label ">รหัสการซื้อ</label>
                     <div class="col-sm-6"><input type="text" disabled name="b_id" placeholder="" class="form-control" required="" value="<?php echo $b_id; ?>"></div>
                  </div>

                  <div class="hr-line-dashed"></div>



                      <div class="form-group has-warning"><label class="col-sm-2 control-label ">เลือกยา </label>
                          <select name="drug" disabled  data-placeholder="Choose a Type..." class="chosen-select" style="width:345px;" tabindex="2">

                        <?php

                        $sql_drug = mysqli_query($conn,"select * from drug where d_id='$d_id'  ")or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                        list($d_id,$d_eng,$d_th,$d_detail,$d_price,$amount,$mfg,$exp,$picture,$type)=mysqli_fetch_array($sql_drug);


                       ?>
                        <option value="<?php echo $d_id; ?>" ><?php echo $d_id." ".$d_eng." ".$d_th ?></option>


                        </select>
                      </div>

                      <input type='hidden' name='drug'  value="<?php echo $d_id ?>">

                      <div class="hr-line-dashed"></div>

                      <?php
                      $today = date("Y-m-d H:s:i");

                      ?>

                      <div class="form-group  has-warning" id="data_5">
                         <label class="col-sm-2 control-label">วันที่ซื้อ</label>
                         <div class="input-daterange input-group" id="datepicker">
                              <input type="text" disabled class="input-sm form-control" name="mfg" value="<?php echo $today;  ?>"/>
                         </div>
                      </div>


                     <div class="hr-line-dashed"></div>

                  <div class="form-group has-warning"><label class="col-sm-2 control-label ">จำนวน</label>
                       <div class="col-sm-5"><input type="text" disabled name="amount"  placeholder="" class="form-control" required="" value="<?php echo $b_amount; ?>"></div>
                  </div>
                  <input type='hidden' name='b_amount'  value="<?php echo $b_amount ?>">



                  <div class="hr-line-dashed"></div>

                  <div class="form-group has-warning"><label class="col-sm-2 control-label" required="">ราคา</label>

                       <div class="col-sm-5"><input type="text" disabled  name="price"  placeholder="" class="form-control" name="password" required="" value="<?php echo $b_price; ?>"></div>
                  </div>

                  <input type='hidden' name='b_price'  value="<?php echo $b_price ?>">


                  <?php
                        $total = $b_price * $b_amount;

                   ?>


                  <div class="form-group has-warning"><label class="col-sm-2 control-label" required="">รวมราคา</label>

                       <div class="col-sm-5"><input type="text" disabled  name="total"  placeholder="" class="form-control" name="password" required="" value="<?php echo $total; ?>"></div>
                  </div>


                  <input type='hidden' name='b_total'  value="<?php echo $total ?>">




                  <div class="hr-line-dashed"></div>


                  <input type='hidden' name='b_id'  value="<?php echo $b_id ?>">




                  <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-1">
                        <button class="btn btn-white"  type="button" onclick="window.location='index.php?module=buy&action=insert_buy_form'">ย้อนกลับ</button>
                          <button class="btn btn-primary" type="submit" name="submit" >บันทึก</button>
                      </div>
                 </div>


               </form>
            </div>

               </div>
          </div>





         </div>
