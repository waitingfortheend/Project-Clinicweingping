<?php

	//unset($_SESSION['valid_user']);
	//unset($_SESSION['login_type']);
	session_destroy();
	echo "<script>window.location='../index.php'</script>";
?>
