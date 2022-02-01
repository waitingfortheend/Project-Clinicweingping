
<?php
   $total =  $_GET['total'];
   $cnt = count($_SESSION['sdrug_id']);



            $buy_date = date("Y-m-d H:i:s");


            $sql1="INSERT INTO buy(buy_id,buy_date,buy_total) Values('','$buy_date','$total')";

            mysqli_query($conn,$sql1) or die(" sql1 = ".mysql_error());

            $drug_id = "D".sprintf("%05d",substr($_SESSION['sdrug_id'][0],-5));
            $price = $_SESSION['drug_price'][0];
            $amount = $_SESSION['drug_amount'][0];


            $sqlse = mysqli_query($conn,"SELECT MAX(buy_id) FROM buy");
                  list($MAX)=mysqli_fetch_array($sqlse);

                  $sql2 = "INSERT INTO buy_detail(buy_id,d_id,b_price,b_amount) VALUES('$MAX','$drug_id','$price','$amount')";


                  $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$drug_id'")or die(" sql_d = ".mysql_error()) ;
                  list($d_amount)=mysqli_fetch_array($sql_d);


                  $sum_amount = $d_amount + $amount;

//                  $sql_drug =("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$drug_id'");
//                  mysqli_query($conn,$sql_drug)or die(mysql_error());



         	for($i=1;$i<$cnt;$i++){
               $drug_id = "D".sprintf("%05d",substr($_SESSION['sdrug_id'][$i],-5));
               $price = $_SESSION['drug_price'][$i];
               $amount = $_SESSION['drug_amount'][$i];
               $sql2 .= ",('$MAX','$drug_id','$price','$amount')";

               $sql_d = mysqli_query($conn,"select amount from drug where d_id ='$drug_id'")or die(" sql_d = ".mysql_error()) ;
               list($d_amount)=mysqli_fetch_array($sql_d);
               $sum_amount = $d_amount + $amount;

                
//               $sql_drug =("UPDATE drug SET amount='$sum_amount' WHERE d_id ='$drug_id'");
//               mysqli_query($conn,$sql_drug)or die(mysql_error());
//


         	}


            mysqli_query($conn,$sql2) or die("sql2 =".mysql_error());


         	unset($_SESSION['sdrug_id']);
         	unset($_SESSION['drug_name_eng']);
            unset($_SESSION['drug_price']);
            unset($_SESSION['drug_amount']);

         	echo "<script>alert('บันทึกการสั่งซื้อเรียบร้อยแล้ว')</script>";
         	echo "<script>window.location='index.php?module=buy&action=buy_manage&active=active9'</script>";





?>
