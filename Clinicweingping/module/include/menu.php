
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">

                <?php   if (isset($_SESSION['login_type'])) { ?>
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
 
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <span class="clear"> <span class="block m-t-xs"> <strong
                                    class="font-bold">ยินดีต้อนรับ </strong><?php echo $_SESSION['valid_user']; ?><b
                                class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="index.php?module=user&action=profile">Profile</a></li>

                            <li class="divider"></li>
                            <li><a href="index.php?module=user&action=logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <?php

                        if($_SESSION['login_type']=="Admin"){
                            echo "Admin";

                        }elseif ($_SESSION['login_type']=="Employee"){
                            echo "Emp";
                        }elseif ($_SESSION['login_type']=="Owner"){
                            echo "Owner";
                        }elseif ($_SESSION['login_type']=="Veterinary"){
                            echo "Vet";
                        }



//                        echo $_SESSION['valid_user'];


                        ?>

                    </div>
                </li>

                <?php  }?>
                <!---------------------- MENU ------------------------->
                <?php

                if (empty($_GET['active'])) {
                    $ac1 = "";
                    $ac2 = "";
                    $ac3 = "";
                    $ac4 = "";
                    $ac5 = "";
                    $ac6 = "";
                    $ac7 = "";
                    $ac8 = "";
                    $ac9 = "";
                    $ac10 = "";
                    $ac11 = "";
                    $ac12 = "";
                    $ac13 = "";
                    $ac14 = "";
                    $ac15 = "";
                    $ac16 = "";
                    $ac17 = "";
                    $ac18 = "";
                    $ac19 = "";
                    $ac20 = "";
                    $ac21 = "";
                    $ac22 = "";
                    $ac23 = "";
                    $ac24 = "";
                    $ac25 = "";

                    $activelv1 = "";
                    $activelv2 = "";
                    $activelv3 = "";
                    $activelv4 = "";
                    $activelv5 = "";
                    $activelv6 = "";
                    $activelv7 = "";
                    $activelv8 = "";
                    $activelv9 = "";
                    $activelv10 = "";
                    $activelv11 = "";

                } else {
                    if ($_GET['active'] == "active1") {
                        $activelv1 = "active";
                        $ac1 = "active";

                    } elseif ($_GET['active'] == "active2") {
                        $activelv1 = "active";
                        $ac2 = "active";

                    } elseif ($_GET['active'] == "active3") {
                        $activelv2 = "active";
                        $ac3 = "active";

                    } elseif ($_GET['active'] == "active4") {
                        $activelv2 = "active";
                        $ac4 = "active";

                    } elseif ($_GET['active'] == "active5") {
                        $activelv3 = "active";
                        $ac5 = "active";

                    } elseif ($_GET['active'] == "active6") {
                        $activelv3 = "active";
                        $ac6 = "active";

                    } elseif ($_GET['active'] == "active7") {
                        $activelv4 = "active";
                        $ac7 = "active";

                    } elseif ($_GET['active'] == "active8") {
                        $activelv4 = "active";
                        $ac8 = "active";

                    } elseif ($_GET['active'] == "active9") {
                        $activelv5 = "active";
                        $ac9 = "active";

                    } elseif ($_GET['active'] == "active10") {
                        $activelv5 = "active";
                        $ac10 = "active";

                    } elseif ($_GET['active'] == "active11") {
                        $activelv6 = "active";
                        $ac11 = "active";

                    } elseif ($_GET['active'] == "active12") {
                        $activelv6 = "active";
                        $ac12 = "active";

                    } elseif ($_GET['active'] == "active13") {
                        $activelv7 = "active";
                        $ac13 = "active";

                    } elseif ($_GET['active'] == "active15") {
                        $activelv8 = "active";
                        $ac15 = "active";

                    } elseif ($_GET['active'] == "active16") {
                        $activelv8 = "active";
                        $ac16 = "active";

                    } elseif ($_GET['active'] == "active17") {
                        $activelv9 = "active";
                        $ac17 = "active";

                    } elseif ($_GET['active'] == "active18") {
                        $activelv10 = "active";
                        $ac18 = "active";

                    } elseif ($_GET['active'] == "active19") {
                        $activelv10 = "active";
                        $ac19 = "active";

                    } elseif ($_GET['active'] == "active20") {
                        $activelv10 = "active";
                        $ac20 = "active";

                    } elseif ($_GET['active'] == "active21") {
                        $activelv10 = "active";
                        $ac21 = "active";

                    } elseif ($_GET['active'] == "active22") {
                        $activelv10 = "active";
                        $ac22 = "active";

                    } elseif ($_GET['active'] == "active23") {
                        $activelv10 = "active";
                        $ac23 = "active";

                    } elseif ($_GET['active'] == "active24") {
                        $activelv9 = "active";
                        $ac24 = "active";

                    } elseif ($_GET['active'] == "active25") {
                        $activelv11 = "active";
                        $ac25 = "active";

                    } elseif ($_GET['active'] == "active26") {
                        $activelv12 = "active";
                        $ac26 = "active";

                    }


                }


                if (isset($_SESSION['login_type'])) {

                    switch ($_SESSION['login_type']) {
                        case 'Admin':
                            admin_menu();
                            break;
                        case 'Employee':
                            emp_menu();

                            break;
                        case 'Owner':

                            owner_menu();

                            break;
                        case 'Veterinary':
                            Veterinary_menu();

                            break;

                    }

                }


                ?>




                <?php
                function owner_menu()
                {


                    if (empty($_GET['active'])) {
                        $ac1 = "";
                        $ac2 = "";
                        $ac3 = "";
                        $ac4 = "";
                        $ac5 = "";
                        $ac6 = "";
                        $ac7 = "";
                        $ac8 = "";
                        $ac9 = "";
                        $ac10 = "";
                        $ac11 = "";
                        $ac12 = "";
                        $ac13 = "";
                        $ac14 = "";
                        $ac15 = "";
                        $ac16 = "";
                        $ac17 = "";
                        $ac18 = "";
                        $ac19 = "";
                        $ac20 = "";
                        $ac21 = "";
                        $ac22 = "";
                        $ac23 = "";
                        $ac24 = "";
                        $ac25 = "";

                        $activelv1 = "";
                        $activelv2 = "";
                        $activelv3 = "";
                        $activelv4 = "";
                        $activelv5 = "";
                        $activelv6 = "";
                        $activelv7 = "";
                        $activelv8 = "";
                        $activelv9 = "";
                        $activelv10 = "";
                        $activelv11 = "";

                    } else {
                        if ($_GET['active'] == "active1") {
                            $activelv1 = "active";
                            $ac1 = "active";

                        } elseif ($_GET['active'] == "active2") {
                            $activelv1 = "active";
                            $ac2 = "active";

                        } elseif ($_GET['active'] == "active3") {
                            $activelv2 = "active";
                            $ac3 = "active";

                        } elseif ($_GET['active'] == "active4") {
                            $activelv2 = "active";
                            $ac4 = "active";

                        } elseif ($_GET['active'] == "active5") {
                            $activelv3 = "active";
                            $ac5 = "active";

                        } elseif ($_GET['active'] == "active6") {
                            $activelv3 = "active";
                            $ac6 = "active";

                        } elseif ($_GET['active'] == "active7") {
                            $activelv4 = "active";
                            $ac7 = "active";

                        } elseif ($_GET['active'] == "active8") {
                            $activelv4 = "active";
                            $ac8 = "active";

                        } elseif ($_GET['active'] == "active9") {
                            $activelv5 = "active";
                            $ac9 = "active";

                        } elseif ($_GET['active'] == "active10") {
                            $activelv5 = "active";
                            $ac10 = "active";

                        } elseif ($_GET['active'] == "active11") {
                            $activelv6 = "active";
                            $ac11 = "active";

                        } elseif ($_GET['active'] == "active12") {
                            $activelv6 = "active";
                            $ac12 = "active";

                        } elseif ($_GET['active'] == "active13") {
                            $activelv7 = "active";
                            $ac13 = "active";

                        } elseif ($_GET['active'] == "active15") {
                            $activelv8 = "active";
                            $ac15 = "active";

                        } elseif ($_GET['active'] == "active16") {
                            $activelv8 = "active";
                            $ac16 = "active";

                        } elseif ($_GET['active'] == "active17") {
                            $activelv9 = "active";
                            $ac17 = "active";

                        } elseif ($_GET['active'] == "active18") {
                            $activelv10 = "active";
                            $ac18 = "active";

                        } elseif ($_GET['active'] == "active19") {
                            $activelv10 = "active";
                            $ac19 = "active";

                        } elseif ($_GET['active'] == "active20") {
                            $activelv10 = "active";
                            $ac20 = "active";

                        } elseif ($_GET['active'] == "active21") {
                            $activelv10 = "active";
                            $ac21 = "active";

                        } elseif ($_GET['active'] == "active22") {
                            $activelv10 = "active";
                            $ac22 = "active";

                        } elseif ($_GET['active'] == "active23") {
                            $activelv10 = "active";
                            $ac23 = "active";

                        } elseif ($_GET['active'] == "active24") {
                            $activelv9 = "active";
                            $ac24 = "active";

                        } elseif ($_GET['active'] == "active25") {
                            $activelv11 = "active";
                            $ac25 = "active";

                        } elseif ($_GET['active'] == "active26") {
                            $activelv12 = "active";
                            $ac26 = "active";

                        }


                    }

                    ?>

                    <li class="<?php echo $activelv1; ?>">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">เมนูข้อมูลพนักงาน</span> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac1; ?>"><a
                                    href="index.php?module=user&action=user_manage&active=<?php echo "active1"; ?>">จัดการข้อมูลพนักงาน</a>
                            </li>

                        </ul>
                    </li>


                    <?php



                    // $servername = "localhost";
                    // $username ="root";
                    // $password = "";
                    // $dbname ="clinicwiangpink";

                    // $conn = mysqli_connect($servername , $username ,$password ,$dbname);
                    include ("include/connect_db.php");
                    $count = 0;
                    $sql_drug = mysqli_query($conn,"select amount from drug where amount <= 10  ") or die(mysql_error()); // เรียกใช้คำสั่ง SQL

                    


                    while (list($amount) = mysqli_fetch_array($sql_drug)) { //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                        $count = $count + $amount;

                    }

                    ?>

                    <li class="<?php echo $activelv5; ?>">
                        <a href="#"><i class="fa fa-shopping-cart"></i> <span
                                class="nav-label">เมนูการซื้อ <br><i class="fa fa-eyedropper"></i>ยาใกล้หมด (<?php echo $count; ?>) </span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac9; ?>"><a
                                    href="index.php?module=buy&action=buy_manage&active=<?php echo "active9"; ?>">จัดการข้อมูลการซื้อ</a>
                            </li>
                            <li class="<?php echo $ac10; ?>"><a
                                    href="index.php?module=drug&action=show_cart&active=<?php echo "active10"; ?>">รายการซื้อ</a>
                            </li>
                        </ul>

                    </li>


                    <li class="<?php echo $activelv10; ?>">
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">เมนูรายงาน</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac18; ?>"><a
                                    href="index.php?module=report&action=earnings_reports&active=<?php echo "active18"; ?>">รายงานรายรับ</a>
                            </li>
                            <li class="<?php echo $ac19; ?>"><a
                                    href="index.php?module=report&action=expenditure&active=<?php echo "active19"; ?>">รายงานการซื้อ</a>
                            </li>
                            <li class="<?php echo $ac20; ?>"><a
                                    href="index.php?module=report&action=drug_stocks&active=<?php echo "active20"; ?>">รายงานยาคงเหลือ</a>
                            </li>
                            <li class="<?php echo $ac21; ?>"><a
                                    href="index.php?module=report&action=report_dispensation&active=<?php echo "active21"; ?>">รายงานการขายยา</a>
                            </li>
                            <li class="<?php echo $ac22; ?>"><a
                                    href="index.php?module=report&action=report_treatment&active=<?php echo "active22"; ?>">รายงานการรักษาสัตว์</a>
                            </li>
                            <li class="<?php echo $ac23; ?>"><a
                                    href="index.php?module=report&action=report_service&active=<?php echo "active23"; ?>">รายงานการบริการ</a>
                            </li>


                        </ul>

                    </li>


                <?php } ?>



                <?php

                function emp_menu()
                {


                    if (empty($_GET['active'])) {
                        $ac1 = "";
                        $ac2 = "";
                        $ac3 = "";
                        $ac4 = "";
                        $ac5 = "";
                        $ac6 = "";
                        $ac7 = "";
                        $ac8 = "";
                        $ac9 = "";
                        $ac10 = "";
                        $ac11 = "";
                        $ac12 = "";
                        $ac13 = "";
                        $ac14 = "";
                        $ac15 = "";
                        $ac16 = "";
                        $ac17 = "";
                        $ac18 = "";
                        $ac19 = "";
                        $ac20 = "";
                        $ac21 = "";
                        $ac22 = "";
                        $ac23 = "";
                        $ac24 = "";
                        $ac25 = "";

                        $activelv1 = "";
                        $activelv2 = "";
                        $activelv3 = "";
                        $activelv4 = "";
                        $activelv5 = "";
                        $activelv6 = "";
                        $activelv7 = "";
                        $activelv8 = "";
                        $activelv9 = "";
                        $activelv10 = "";
                        $activelv11 = "";

                    } else {
                        if ($_GET['active'] == "active1") {
                            $activelv1 = "active";
                            $ac1 = "active";

                        } elseif ($_GET['active'] == "active2") {
                            $activelv1 = "active";
                            $ac2 = "active";

                        } elseif ($_GET['active'] == "active3") {
                            $activelv2 = "active";
                            $ac3 = "active";

                        } elseif ($_GET['active'] == "active4") {
                            $activelv2 = "active";
                            $ac4 = "active";

                        } elseif ($_GET['active'] == "active5") {
                            $activelv3 = "active";
                            $ac5 = "active";

                        } elseif ($_GET['active'] == "active6") {
                            $activelv3 = "active";
                            $ac6 = "active";

                        } elseif ($_GET['active'] == "active7") {
                            $activelv4 = "active";
                            $ac7 = "active";

                        } elseif ($_GET['active'] == "active8") {
                            $activelv4 = "active";
                            $ac8 = "active";

                        } elseif ($_GET['active'] == "active9") {
                            $activelv5 = "active";
                            $ac9 = "active";

                        } elseif ($_GET['active'] == "active10") {
                            $activelv5 = "active";
                            $ac10 = "active";

                        } elseif ($_GET['active'] == "active11") {
                            $activelv6 = "active";
                            $ac11 = "active";

                        } elseif ($_GET['active'] == "active12") {
                            $activelv6 = "active";
                            $ac12 = "active";

                        } elseif ($_GET['active'] == "active13") {
                            $activelv7 = "active";
                            $ac13 = "active";

                        } elseif ($_GET['active'] == "active15") {
                            $activelv8 = "active";
                            $ac15 = "active";

                        } elseif ($_GET['active'] == "active16") {
                            $activelv8 = "active";
                            $ac16 = "active";

                        } elseif ($_GET['active'] == "active17") {
                            $activelv9 = "active";
                            $ac17 = "active";

                        } elseif ($_GET['active'] == "active18") {
                            $activelv10 = "active";
                            $ac18 = "active";

                        } elseif ($_GET['active'] == "active19") {
                            $activelv10 = "active";
                            $ac19 = "active";

                        } elseif ($_GET['active'] == "active20") {
                            $activelv10 = "active";
                            $ac20 = "active";

                        } elseif ($_GET['active'] == "active21") {
                            $activelv10 = "active";
                            $ac21 = "active";

                        } elseif ($_GET['active'] == "active22") {
                            $activelv10 = "active";
                            $ac22 = "active";

                        } elseif ($_GET['active'] == "active23") {
                            $activelv10 = "active";
                            $ac23 = "active";

                        } elseif ($_GET['active'] == "active24") {
                            $activelv9 = "active";
                            $ac24 = "active";

                        } elseif ($_GET['active'] == "active25") {
                            $activelv11 = "active";
                            $ac25 = "active";

                        } elseif ($_GET['active'] == "active26") {
                            $activelv12 = "active";
                            $ac26 = "active";

                        }elseif ($_GET['active'] == "active27") {
                            $activelv7 = "active";
                            $ac27 = "active";

                        }


                    }

                    ?>

                    <li class="<?php echo $activelv2; ?>">
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">เมนูข้อมูลลูกค้า</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac3; ?>"><a
                                    href="index.php?module=customer&action=customer_manage&active=<?php echo "active3"; ?>">จัดการข้อมูลลูกค้า</a>
                            </li>

                        </ul>
                    </li>


                    <li class="<?php echo $activelv3; ?>">

                        <a href="index.php?module=pet&action=pet_manage"><i class="fa fa-paw"></i> <span
                                class="nav-label">เมนูข้อมูลสัตว์เลี้ยง</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?php echo $ac5; ?>"><a
                                    href="index.php?module=pet&action=pet_manage&active=<?php echo "active5"; ?>">จัดการข้อมูลสัตว์</a>
                            </li>

                            <li class="<?php echo $ac6; ?>"><a
                                    href="index.php?module=pet&action=pet_type_manage&active=<?php echo "active6"; ?>">จัดการประเภทสัตว์เลี้ยง</a>
                            </li>

                        </ul>

                    </li>


                    <li class="<?php echo $activelv6; ?>">
                        <a href="#"><i class="fa fa-pencil-square"></i> <span
                                class="nav-label">เมนูการบริการ</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac11; ?>"><a
                                    href="index.php?module=service&action=service_manage&active=<?php echo "active11"; ?>">จัดการข้อมูลการบริการ</a>
                            </li>
                            <li class="<?php echo $ac12; ?>"><a
                                    href="index.php?module=service&action=service_pet_manage&active=<?php echo "active12"; ?>">เพิ่มข้อมูลการบริการ</a>
                            </li>

                        </ul>

                    </li>


                    <li class="<?php echo $activelv8; ?>">
                        <a href="#"><i class="fa fa-eyedropper"></i> <span class="nav-label">เมนูการขายยา</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac15; ?>"><a
                                    href="index.php?module=dispensation&action=dispensation_manage&active=<?php echo "active15"; ?>">ข้อมูลการขายยา</a>
                            </li>

                                                        <li class="<?php echo $ac16;
                            ?>"><a
                                                              href="index.php?module=dispensation&action=dispensation_drug_manage&active=<?php echo "active16"; ?>">เพิ่มข้อมูลการขายยา</a>
                                                       </li>

                        </ul>

                    </li>

                    <li class="<?php echo $activelv7; ?>">
                        <a href="#"><i class="fa fa-hospital-o"></i> <span class="nav-label">เมนูการรักษา</span><span
                                class="fa arrow"></span></a>


                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac13; ?>"><a
                                    href="index.php?module=treatment&action=treatment_detail_emp&active=<?php echo "active13"; ?>">ข้อมูลการรักษา</a>
                            </li>

                        </ul>
                        <ul class="nav nav-second-level">

                        <li class="<?php echo $ac27; ?>"><a
                            href="index.php?module=treatment&action=profile_treatment&active=<?php echo "active27"; ?>">ประวัติการรักษา</a>
                         </li>
                        </ul>

                    </li>

                    <li class="<?php echo $activelv9;; ?>">
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">เมนูการนัด</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">


                            <li class="<?php echo $ac17; ?>"><a
                                    href="index.php?module=appointment&action=appointment_manage&active=<?php echo "active17"; ?>">ตารางการนัด</a>
                            </li>
                            <li class="<?php echo $ac24; ?>"><a
                                    href="index.php?module=appointment&action=app_manage&active=<?php echo "active24"; ?>">ข้อมูลการนัด</a>
                            </li>
                        </ul>



                    </li>

                <?php } ?>






                <?php

                function Veterinary_menu()
                {

                    if (empty($_GET['active'])) {
                        $ac1 = "";
                        $ac2 = "";
                        $ac3 = "";
                        $ac4 = "";
                        $ac5 = "";
                        $ac6 = "";
                        $ac7 = "";
                        $ac8 = "";
                        $ac9 = "";
                        $ac10 = "";
                        $ac11 = "";
                        $ac12 = "";
                        $ac13 = "";
                        $ac14 = "";
                        $ac15 = "";
                        $ac16 = "";
                        $ac17 = "";
                        $ac18 = "";
                        $ac19 = "";
                        $ac20 = "";
                        $ac21 = "";
                        $ac22 = "";
                        $ac23 = "";
                        $ac24 = "";
                        $ac25 = "";

                        $activelv1 = "";
                        $activelv2 = "";
                        $activelv3 = "";
                        $activelv4 = "";
                        $activelv5 = "";
                        $activelv6 = "";
                        $activelv7 = "";
                        $activelv8 = "";
                        $activelv9 = "";
                        $activelv10 = "";
                        $activelv11 = "";

                    } else {
                        if ($_GET['active'] == "active1") {
                            $activelv1 = "active";
                            $ac1 = "active";

                        } elseif ($_GET['active'] == "active2") {
                            $activelv1 = "active";
                            $ac2 = "active";

                        } elseif ($_GET['active'] == "active3") {
                            $activelv2 = "active";
                            $ac3 = "active";

                        } elseif ($_GET['active'] == "active4") {
                            $activelv2 = "active";
                            $ac4 = "active";

                        } elseif ($_GET['active'] == "active5") {
                            $activelv3 = "active";
                            $ac5 = "active";

                        } elseif ($_GET['active'] == "active6") {
                            $activelv3 = "active";
                            $ac6 = "active";

                        } elseif ($_GET['active'] == "active7") {
                            $activelv4 = "active";
                            $ac7 = "active";

                        } elseif ($_GET['active'] == "active8") {
                            $activelv4 = "active";
                            $ac8 = "active";

                        } elseif ($_GET['active'] == "active9") {
                            $activelv5 = "active";
                            $ac9 = "active";

                        } elseif ($_GET['active'] == "active10") {
                            $activelv5 = "active";
                            $ac10 = "active";

                        } elseif ($_GET['active'] == "active11") {
                            $activelv6 = "active";
                            $ac11 = "active";

                        } elseif ($_GET['active'] == "active12") {
                            $activelv6 = "active";
                            $ac12 = "active";

                        } elseif ($_GET['active'] == "active13") {
                            $activelv7 = "active";
                            $ac13 = "active";

                        } elseif ($_GET['active'] == "active15") {
                            $activelv8 = "active";
                            $ac15 = "active";

                        } elseif ($_GET['active'] == "active16") {
                            $activelv8 = "active";
                            $ac16 = "active";

                        } elseif ($_GET['active'] == "active17") {
                            $activelv9 = "active";
                            $ac17 = "active";

                        } elseif ($_GET['active'] == "active18") {
                            $activelv10 = "active";
                            $ac18 = "active";

                        } elseif ($_GET['active'] == "active19") {
                            $activelv10 = "active";
                            $ac19 = "active";

                        } elseif ($_GET['active'] == "active20") {
                            $activelv10 = "active";
                            $ac20 = "active";

                        } elseif ($_GET['active'] == "active21") {
                            $activelv10 = "active";
                            $ac21 = "active";

                        } elseif ($_GET['active'] == "active22") {
                            $activelv10 = "active";
                            $ac22 = "active";

                        } elseif ($_GET['active'] == "active23") {
                            $activelv10 = "active";
                            $ac23 = "active";

                        } elseif ($_GET['active'] == "active24") {
                            $activelv9 = "active";
                            $ac24 = "active";

                        } elseif ($_GET['active'] == "active25") {
                            $activelv11 = "active";
                            $ac25 = "active";

                        } elseif ($_GET['active'] == "active26") {
                            $activelv12 = "active";
                            $ac26 = "active";

                        } elseif ($_GET['active'] == "active27") {
                            $activelv7 = "active";
                            $ac27 = "active";

                        }


                    }


                    ?>




                    <li class="<?php echo $activelv4; ?>">
                        <a href="#"  ><i class="fa fa-flask"></i> <span class="nav-label">เมนูข้อมูลคลังยา</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac7; ?>"><a
                                    href="index.php?module=drug&action=drug_manage&active=<?php echo "active7"; ?>">จัดการข้อมูลยา</a>
                            </li>
                            <li class="<?php echo $ac8; ?>"><a
                                    href="index.php?module=drug&action=drug_type_manage&active=<?php echo "active8"; ?>">จัดการข้อมูลประเภทยา</a>
                            </li>
                        </ul>
                    </li>


                    <li class="<?php echo $activelv3; ?>">

                        <a href="index.php?module=pet&action=pet_manage"><i class="fa fa-paw"></i> <span
                                class="nav-label">เมนูข้อมูลสัตว์เลี้ยง</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?php echo $ac5; ?>"><a
                                    href="index.php?module=pet&action=pet_manage&active=<?php echo "active5"; ?>">จัดการข้อมูลสัตว์</a>
                            </li>

                            <li class="<?php echo $ac6; ?>"><a
                                    href="index.php?module=pet&action=pet_type_manage&active=<?php echo "active6"; ?>">จัดการประเภทสัตว์เลี้ยง</a>
                            </li>

                        </ul>

                    </li>


                    <li class="<?php echo $activelv7; ?>">
                        <a href="#"><i class="fa fa-hospital-o"></i> <span class="nav-label">เมนูการรักษา</span><span
                                class="fa arrow"></span></a>


                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac13; ?>"><a
                                    href="index.php?module=treatment&action=treatment_manage&active=<?php echo "active13"; ?>">ข้อมูลการรักษา</a>
                            </li>

                        </ul>
                        <ul class="nav nav-second-level">

                            <li class="<?php echo $ac27; ?>"><a
                                    href="index.php?module=treatment&action=profile_treatment&active=<?php echo "active27"; ?>">ประวัติการรักษา</a>
                            </li>
                        </ul>

                    </li>

                    <li class="<?php echo $activelv8; ?>">
                        <a href="#"><i class="fa fa-eyedropper"></i> <span class="nav-label">เมนูการขายยา</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $ac15; ?>"><a
                                    href="index.php?module=dispensation&action=dispensation_manage&active=<?php echo "active15"; ?>">ข้อมูลการขายยา</a>
                            </li>

                            <li class="<?php echo $ac16;
                            ?>"><a
                                    href="index.php?module=dispensation&action=dispensation_drug_manage&active=<?php echo "active16"; ?>">เพิ่มข้อมูลการขายยา</a>
                            </li>

                        </ul>

                    </li>
                    <li class="<?php echo $activelv9;; ?>">
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">เมนูการนัด</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">


                            <li class="<?php echo $ac17; ?>"><a
                                    href="index.php?module=appointment&action=appointment_manage&active=<?php echo "active17"; ?>">ตารางการนัด</a>
                            </li>


                            <li class="<?php echo $ac24; ?>"><a
                                    href="index.php?module=appointment&action=app_manage&active=<?php echo "active24"; ?>">ข้อมูลการนัด</a>
                            </li>
                        </ul>

                    </li>

                    <li class="<?php echo $activelv12; ?>">
                        <a href="#"><i class="fa fa-eyedropper"></i> <span
                                class="nav-label">ข้อมูลวินิจฉัยโรค</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">

                            <li class="<?php echo $ac26; ?>"><a
                                    href="index.php?module=disease&action=disease_manage&active=<?php echo "active26"; ?>">จัดการข้อมูลวินิจฉัยโรค</a>
                            </li>

                        </ul>

                    </li>


                <?php } ?>





                <?php

                function admin_menu()
                {


                    if (empty($_GET['active'])) {
                        $ac1 = "";
                        $ac2 = "";
                        $ac3 = "";
                        $ac4 = "";
                        $ac5 = "";
                        $ac6 = "";
                        $ac7 = "";
                        $ac8 = "";
                        $ac9 = "";
                        $ac10 = "";
                        $ac11 = "";
                        $ac12 = "";
                        $ac13 = "";
                        $ac14 = "";
                        $ac15 = "";
                        $ac16 = "";
                        $ac17 = "";
                        $ac18 = "";
                        $ac19 = "";
                        $ac20 = "";
                        $ac21 = "";
                        $ac22 = "";
                        $ac23 = "";
                        $ac24 = "";
                        $ac25 = "";

                        $activelv1 = "";
                        $activelv2 = "";
                        $activelv3 = "";
                        $activelv4 = "";
                        $activelv5 = "";
                        $activelv6 = "";
                        $activelv7 = "";
                        $activelv8 = "";
                        $activelv9 = "";
                        $activelv10 = "";
                        $activelv11 = "";

                    } else {
                        if ($_GET['active'] == "active1") {
                            $activelv1 = "active";
                            $ac1 = "active";

                        } elseif ($_GET['active'] == "active2") {
                            $activelv1 = "active";
                            $ac2 = "active";

                        } elseif ($_GET['active'] == "active3") {
                            $activelv2 = "active";
                            $ac3 = "active";

                        } elseif ($_GET['active'] == "active4") {
                            $activelv2 = "active";
                            $ac4 = "active";

                        } elseif ($_GET['active'] == "active5") {
                            $activelv3 = "active";
                            $ac5 = "active";

                        } elseif ($_GET['active'] == "active6") {
                            $activelv3 = "active";
                            $ac6 = "active";

                        } elseif ($_GET['active'] == "active7") {
                            $activelv4 = "active";
                            $ac7 = "active";

                        } elseif ($_GET['active'] == "active8") {
                            $activelv4 = "active";
                            $ac8 = "active";

                        } elseif ($_GET['active'] == "active9") {
                            $activelv5 = "active";
                            $ac9 = "active";

                        } elseif ($_GET['active'] == "active10") {
                            $activelv5 = "active";
                            $ac10 = "active";

                        } elseif ($_GET['active'] == "active11") {
                            $activelv6 = "active";
                            $ac11 = "active";

                        } elseif ($_GET['active'] == "active12") {
                            $activelv6 = "active";
                            $ac12 = "active";

                        } elseif ($_GET['active'] == "active13") {
                            $activelv7 = "active";
                            $ac13 = "active";

                        } elseif ($_GET['active'] == "active15") {
                            $activelv8 = "active";
                            $ac15 = "active";

                        } elseif ($_GET['active'] == "active16") {
                            $activelv8 = "active";
                            $ac16 = "active";

                        } elseif ($_GET['active'] == "active17") {
                            $activelv9 = "active";
                            $ac17 = "active";

                        } elseif ($_GET['active'] == "active18") {
                            $activelv10 = "active";
                            $ac18 = "active";

                        } elseif ($_GET['active'] == "active19") {
                            $activelv10 = "active";
                            $ac19 = "active";

                        } elseif ($_GET['active'] == "active20") {
                            $activelv10 = "active";
                            $ac20 = "active";

                        } elseif ($_GET['active'] == "active21") {
                            $activelv10 = "active";
                            $ac21 = "active";

                        } elseif ($_GET['active'] == "active22") {
                            $activelv10 = "active";
                            $ac22 = "active";

                        } elseif ($_GET['active'] == "active23") {
                            $activelv10 = "active";
                            $ac23 = "active";

                        } elseif ($_GET['active'] == "active24") {
                            $activelv9 = "active";
                            $ac24 = "active";

                        } elseif ($_GET['active'] == "active25") {
                            $activelv11 = "active";
                            $ac25 = "active";

                        } elseif ($_GET['active'] == "active26") {
                            $activelv12 = "active";
                            $ac26 = "active";

                        }


                    }


                    ?>
                    <li class="<?php echo $activelv11;; ?>">
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">เมนูกำหนดสิทธิ์ผู้ใช้</span><span
                                class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">


                            <li class="<?php echo $ac25; ?>"><a
                                    href="index.php?module=permissions&action=permissions_manage&active=<?php echo "active25"; ?>">จัดการข้อมูลสิทธิ์</a>
                            </li>


                        </ul>

                    </li>


                    <?php

                }

                ?>


            </ul>


        </div>
    </nav>


<!--    disabled="disabled"-->
<!--    <style type="text/css">-->
<!--    a[disabled="disabled"] {-->
<!--    pointer-events: none;-->
<!--    }-->
<!--    </style>-->

    