
             <div class="row">
                 <div class="col-lg-15">
                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                             <h5>จัดการข้อมูลการบริการ</h5>

                             <div class="ibox-tools">

                                 <a class="close-link">
                                     <i class="fa fa-times"></i>
                                 </a>
                             </div>
                        </div>
               <div class="ibox-content">



   <center><button type="button" class="btn btn-w-m btn-success" ONCLICK=window.location.href='index.php?module=service&action=service_pet_manage'>เพิ่มข้อมูลการบริการ</button></center><br>

<?php

      if(empty($total_price)){
         $total_price="";

      }

      echo "<form method='post' action='index.php?module=service&action=ser_recalculate'>";


      $total_price =0;

      if(empty($_SESSION['spet_id'])){
         echo "<p align='center'>ยังไม่มีสินค้าที่ต้องการเพิ่ม</p>";

      }else{

      $cnt = count($_SESSION['spet_id']);

      $chk_del='';
      if(empty($_GET['chk_del'])){
         $chk='';

         $val=1;
         $color='white';

      }else{
         $chk='checked';//ให้ติ๊ก checkbox
         $val='';//กำหนดค่าที่ส่งจากตัวแปร $_GET['chk_del']
         $color='#D5EAFF';

      }




      if($cnt>0){
         echo "<div class='table-responsive'>";
      echo"<table class='footable table table-stripped toggle-arrow-tiny' data-page-size='15' data-filter=#filter>";
      echo"<thead><tr><th>ลบ</th><th>รหัสสัตว์</th><th>ชื่อสัตว์</th><th>ฆ</th><th>จำนวน</th><th>ราคารวม</th></tr></thead>";
      echo "<tbody>";
      for($i=0;$i<$cnt;$i++){


      echo "<tr class='gradeU'>
      <td>
      <div class='i-checks'>

      <input  $chk   type='checkbox' name='cancel_id[]' value=",$_SESSION['spet_id'][$i],">

      </div>
      </td>";

      echo "<td>";
      echo $_SESSION['spet_id'][$i],"</td><td>";
      echo $_SESSION['spet_name'][$i],"</td>";



      }


      echo"<tr>
      <td> <button class='btn btn-outline btn-primary dim'  type='button' ONCLICK=window.location.href='index.php?module=drug&action=show_cart&chk_del=$val'><i class='fa fa-check'></i>
      </button></td>

      </tr>";

            echo "</tbody>";
      echo "<tfoot>";
      echo "<tr>";
          echo "<td colspan='6'>";
            echo "<ul class='pagination pull-right'></ul>";
          echo "</td>";
      echo "</tr>";
      echo "<input type='hidden' name='total_price' value='$total_price'";


      echo "</tfoot>";

      echo "</table>";


      echo "<input type='submit' class='btn btn-w-m btn-warning' name='button' value='คำนวณใหม่'> ";
      echo "<input type='submit' class='btn btn-w-m btn-info' name='button' onclick='return confirm(\"ยืนยันการซื้อ  ?\")' value='ยืนยันการสั่งซื้อ'>";

      echo "</form>";

      }else{

      echo "<p align='center'>ยังไม่มบริการที่ต้องการเพิ่ม</p>";
      }

}





?>
   </div>
</div>
</div>
</div>
</div>
