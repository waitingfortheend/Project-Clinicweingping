

<?php
	if(!empty($_POST['user'])){
      $user = $_POST['user'];
	}

   if(!empty($_POST['pass'])){
      $pass = $_POST['pass'];
	}
   if(!empty($_POST['name'])){
      $name = $_POST['name'];
	}
   if(!empty($_POST['surname'])){
      $surname =  $_POST['surname'];
	}

   if(!empty($_POST['address'])){
      $address= $_POST['address'];
	}
   if(!empty($_POST['tel'])){
      $telephone = $_POST['tel'];
	}
   if(!empty($_POST['type'])){
      $type =  $_POST['type'];
	}



   $sql = "select user_name from user where user_name = '$_POST[user]' ";

   $rs = mysqli_query($conn,$sql);
   list($db_user) = mysqli_fetch_array($rs);

   if($db_user == $_POST['user']){

   	echo " <script>alert('username ซ้ำ กรุณากรอกใหม่')</script>";
      echo "<script>window.location='index.php?module=user&action=user_manage&active=active1'</script>";
   }else{

		$sql = "INSERT INTO user(user_name,password,type_id) values('$_POST[user]','$_POST[pass]','$_POST[type]')";
		$sql_emp = "INSERT INTO employee(emp_name,emp_surname,emp_address,emp_telephone,user_name) values('$_POST[name]','$_POST[surname]','$_POST[address]','$_POST[tel]','$_POST[user]')";


	if(mysqli_query($conn,$sql)or die(mysql_error())){
		mysqli_query($conn,$sql_emp)or die(mysql_error());

		echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
		echo "<script>window.location='index.php?module=user&action=user_manage&active=active1'</script>";

	}else{
		echo "<script>alert('เกิดความผิดพลาดไม่สามารถเพิ่มข้อมูลได้')</script>";
			echo "<script>window.location='index.php?module=user&action=user_manage&active=active1'</script>";
	}


}









?>
