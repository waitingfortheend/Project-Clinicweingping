<?php
	// mysql_connect("localhost","root","");//ติดต่อฐานข้อมูล
	// //รูปแบบ : mysql_connect("ชื่อ host","ชื่อ user","รหัสผ่าน");
	// mysql_select_db("clinicwiangpink");//เลือกฐานข้อมูล
	// mysqli_query($conn,"SET NAMES UTF8"); //เรียกใช้คำสั่งกำหนดชุดถอดรหัสตัวอักษรให้รองรับภาษาไทย

	
    $servername = "localhost";
    $username ="root";
    $password = "";
    $dbname ="clinicwiangpink";

    $conn = mysqli_connect($servername , $username ,$password ,$dbname);

    if(!$conn) {

        die("Connection failed" . mysqli_connect_error());

	} 
	
?>
