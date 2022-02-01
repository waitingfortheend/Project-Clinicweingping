<?php


if ($_POST['button'] == "คำนวณใหม่") {

	if (isset($_POST['cancel_id'])) {

		$cnt = count($_SESSION['sdrug_id']);

		if ($cnt >= 0) {


			for ($i = 0; $i < $cnt; $i++) {

				if (!in_array($_SESSION['sdrug_id'][$i], $_POST['cancel_id'])) {
					$tdrug_id[] = $_SESSION['sdrug_id'][$i];
					$tdrug_name_eng[] = $_SESSION['drug_name_eng'][$i];
					$tdrug_price[] = $_SESSION['drug_price'][$i];
					$tdrug_amount[] = $_SESSION['drug_amount'][$i];
					$tdrug_all[] =$_SESSION['all'][$i];

				}

			}

		}

		if (empty($tdrug_id)) {
			$tdrug_id = "";
		}
		if (empty($tdrug_name_eng)) {
			$tdrug_name_eng = "";
		}
		if (empty($tdrug_price)) {
			$tdrug_price = "";
		}
		if (empty($tdrug_amount)) {
			$tdrug_amount = "";
		}
		if(empty($tdrug_all)){
			$tdrug_all = "";
		}
		$_SESSION['sdrug_id'] = $tdrug_id;
		$_SESSION['drug_name_eng'] = $tdrug_name_eng;
		$_SESSION['drug_price'] = $tdrug_price;
		$_SESSION['drug_amount'] = $tdrug_amount;
		$_SESSION['all'] = $tdrug_all;

	}


	for($i=0;$i<count($_POST['amount']);$i++){
		if(empty($_SESSION['all'][$i])){

		}else{

		if($_SESSION['all'][$i] >= $_POST['amount'][$i] and $_POST['amount'][$i]>=1){

			$_SESSION['drug_amount'][$i] = $_POST['amount'][$i];

		}else{
			?>

			<script>

				alert("<?php  echo "จำนวน".$_SESSION['sdrug_id'][$i]." คงเหลือ "
					.$_SESSION['all'][$i] . $_SESSION['unit'][$i]
					?>");
			</script>

			<?php
			$_SESSION['drug_amount'][$i] = 1;

		}

		}
	}


	echo "<script>window.location='index.php?module=treatment&action=insert_treatment&active=active13'</script>";


} elseif ($_POST['button'] == "ยืนยันการจ่ายยา") {

	$total = $_POST['total_price'];
	echo "<script>window.location='index.php?module=treatment&action=insert_treatment_all&total=$total'</script>";

}elseif($_POST['button']=="ยกเลิกการทำรายการ"){




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




	echo "<script>window.location='index.php?module=treatment&action=treatment_manage&active=active13'</script>";

}


?>



