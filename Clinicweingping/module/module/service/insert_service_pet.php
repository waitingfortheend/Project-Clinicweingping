
<?php
   $total =  $_GET['total'];
   $cnt = count($_SESSION['spet_id']);

            $service_date = date("Y-m-d H:i:s");





            for ($i=0;$i<$cnt;$i++) {
               if(empty($_SESSION['sdetail'][$i]) or empty($_SESSION['price'][$i])){
                  $chk = "no";
                  echo "<script>alert('กรุณากรอกข้อมูลรายละเอียด และ ราคาให้ครบ')</script>";
                  echo "<script>window.location='index.php?module=service&action=show_service&active=active12'</script>";
               }else{
                  $chk = "ok";
               }

            }


            if($chk=="ok"){



            $sql_service = mysqli_query($conn,"select ser_id from service")or die(mysql_error()); // เรียกใช้คำสั่ง SQL
            while(list($ser_id)=mysqli_fetch_array($sql_service)){ //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

               $new_id =mysql_result(mysqli_query($conn,"Select Max(substr(ser_id,-5))+1 as ser_id from service"),0,"ser_id");//เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย

                        if(empty($new_id)){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
                            $s_id="S00001";
                        }else{
                            $s_id="S".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
                        }

            }


            $spet_detail = $_SESSION['sdetail'][0];
            $spet_id = $_SESSION['spet_id'][0];;
            $sprice = $_SESSION['price'][0];;


               $sql1="INSERT INTO service(ser_id,ser_date,ser_total) Values('$s_id','$service_date','$total')";


            mysqli_query($conn,$sql1) or die(" sql1 = ".mysql_error());



            $ser_new =mysql_result(mysqli_query($conn,"Select Max(substr(ser_id,-5)) as ser_id from service"),0,"ser_id");//เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย

            $new = substr($s_id,-5);
            $new ="S".$new;

            $sql2 = "INSERT INTO service_detail(ser_id,ser_detail,ser_price,pet_id) VALUES('$new','$spet_detail','$sprice','$spet_id')";


            for($i=1;$i<$cnt;$i++){
               $new2 = substr($new,-5);
               $new2 ="S".$new2;

               $spet_id = $_SESSION['spet_id'][$i];
               $sprice = $_SESSION['price'][$i];;
               $sdetail = $_SESSION['sdetail'][$i];

               $sql2 .= ",('$new2','$sdetail','$sprice','$spet_id')";

            }


            mysqli_query($conn,$sql2) or die("sql2 =".mysql_error());


            unset($_SESSION['spet_id']);
            unset($_SESSION['spet_name']);
            unset($_SESSION['sdetail']);
            unset($_SESSION['price']);
            unset($_SESSION['scus_id']);
            unset($_SESSION['search_pet']);


            echo "<script>alert('บันทึกการบริการเรียบร้อยแล้ว')</script>";
            echo "<script>window.location='index.php?module=service&action=service_manage&active=active11'</script>";

            }

?>
