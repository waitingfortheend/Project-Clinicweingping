<?php




if($_POST['button']=="คำนวณใหม่"){

if(isset($_POST['cancel_id'])){

	$cnt=count($_SESSION['spet_id']);

		if($cnt>=0){


		for($i=0;$i<$cnt;$i++){

			if(!in_array($_SESSION['spet_id'][$i],$_POST['cancel_id'])){
				$tspet_id[] = $_SESSION['spet_id'][$i];
				$tpet_name[] = $_SESSION['spet_name'][$i];
            $tpet_detail[] = $_SESSION['sdetail'][$i];
            $tpet_price[] = $_SESSION['price'][$i];


			}

		}

		}

	if(empty($tspet_id)){
		$tspet_id="";
	}
	if(empty($tpet_name)){
		$tpet_name="";
	}
   if(empty($tpet_detail)){
   		$tpet_detail="";

   }
   if(empty($tpet_price)){
         $tpet_price="";
   }

	$_SESSION['spet_id']=$tspet_id;
	$_SESSION['spet_name']=$tpet_name;
    $_SESSION['sdetail']=$tpet_detail;
	$_SESSION['price']=$tpet_price;




}


$_SESSION['sdetail']=$_POST['detail'];
$_SESSION['price']=$_POST['price'];




//นำค่าจำนวนสินค้าที่ส่งจากฟอร์มเก็บเข้าไปแทนใน session
	echo "<script>window.location='index.php?module=service&action=show_service&active=active12'</script>";


}elseif($_POST['button']=="ยืนยันการบริการ"){

	$total=$_POST['total_price'];

   echo "<script>window.location='index.php?module=service&action=insert_service_pet&active=active12&total=$total'</script>";

}


?>
