<?php
	session_start();
	include("include/connect_db.php");
    include("include/function.php");
	date_default_timezone_set('Asia/Bangkok');
?>

<!DOCTYPE html>
<html ng-app="inspinia">

<head>



	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

 
    <link href="css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- FooTable -->
	<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

	<link href="css/animate.css" rel="stylesheet">
 

    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="css/plugins/dropzone/basic.css" rel="stylesheet">
	<link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">


	<link href="css/plugins/iCheck/custom.css" rel="stylesheet">

	<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

	<link href="css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

	<link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">

	<link href="css/plugins/switchery/switchery.css" rel="stylesheet">

	<link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

	<link href="css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

		<link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
	<link href="css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

	<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

	<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">


	<link href="css/plugins/select2/select2.min.css" rel="stylesheet">

	<link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">


    <link href="css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">



	 <!-- FooTable -->


	 <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <!-- Page title set in pageTitle directive -->


    <title page-title>ClinicWeingPing</title>



    <!-- Main Inspinia CSS files -->

    <link id="loadBefore" href="css/style.css" rel="stylesheet">




	 <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">


	 <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">


	 <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	  <link href="css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">





	 <link href="css/style.css" rel="stylesheet">


	 <?php
	   include("include/script.php");

	 ?>

</head>



<body>





   <!---------------------- MENU ------------------------->
   <?php
   include("include/menu.php");
   ?>

   <!---------------------- END MENU ------------------------->



        <!---------------------- Header ------------------------->
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

           <!------------- BUTTON   ----------->
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
          <!------------- BUTTON    ----------->

          <!-------------  HEAD RIGHT  ----------->

            <ul class="nav navbar-top-links navbar-right">

                <li>
                    <span class="m-r-sm text-muted welcome-message"></span>
                </li>



                <li>
                    <a href="index.php?module=user&action=logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>
            <!-------------END RIGHT    ----------->


        </nav>
        </div>

        <!---------------------- END Header ------------------------->



        <!---------------------- BODY ------------------------->





        <?php
        if(empty($_GET['module']) or empty($_GET['action'])){
           echo "<script>window.location='index.php?module=index&action=home'</script>";
           }
        else{
           $module=$_GET['module'];
           $action=$_GET['action'];
           include("module/$module/$action".".php");

           }
        ?>

        <!----------------------  End Body  ---------------->

        <!----------------------  Footer  ---------------->

        <?php
       // include("include/footer.php");
        ?>

         <!----------------------  END Footer  ---------------->


        </div>

      <!----------------------  End Body  ---------------->
    </div>



</body>








</html>
