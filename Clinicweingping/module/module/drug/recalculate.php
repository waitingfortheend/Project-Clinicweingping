<?php




if($_POST['button']=="คำนวณใหม่"){

if(isset($_POST['cancel_id'])){

	$cnt=count($_SESSION['sdrug_id']);

		if($cnt>=0){


		for($i=0;$i<$cnt;$i++){

			if(!in_array($_SESSION['sdrug_id'][$i],$_POST['cancel_id'])){
				$tdrug_id[] = $_SESSION['sdrug_id'][$i];
				$tdrug_name_eng[] = $_SESSION['drug_name_eng'][$i];
				$tdrug_price[] = $_SESSION['drug_price'][$i];
				$tdrug_amount[] = $_SESSION['drug_amount'][$i];

			}

		}

		}

	if(empty($tdrug_id)){
		$tdrug_id="";
		}
	if(empty($tdrug_name_eng)){
		$tdrug_name_eng="";
		}
		if(empty($tdrug_price)){
		$tdrug_price="";
		}	if(empty($tdrug_amount)){
		$tdrug_amount="";
		}
	$_SESSION['sdrug_id']=$tdrug_id;
	$_SESSION['drug_name_eng']=$tdrug_name_eng;
	$_SESSION['drug_price']=$tdrug_price;
	$_SESSION['drug_amount']=$tdrug_amount;

}


$_SESSION['drug_amount']=$_POST['amount'];
//นำค่าจำนวนสินค้าที่ส่งจากฟอร์มเก็บเข้าไปแทนใน session
	echo "<script>window.location='index.php?module=drug&action=show_cart&active=active10'</script>";


}elseif($_POST['button']=="ยืนยันการสั่งซื้อ"){

	$total=$_POST['total_price'];
   echo "<script>window.location='index.php?module=buy&action=insert_buy_drug&total=$total'</script>";

}


?>
