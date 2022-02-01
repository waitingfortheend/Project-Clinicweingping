<?php
session_start();
include("include/connect_db.php");
date_default_timezone_set('Asia/Bangkok');
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>คลินิคเวียงพิงค์รักษาสัตว์</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body id="page-top" class="landing-page">

<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--                    <a class="navbar-brand" href="index.html">WEBAPPLAYERS</a>-->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a class="page-scroll"  href="#page-top" >หน้าหลัก</a></li>
                    <li><a data-toggle="modal" data-target="#myModal6"  onclick="disease();" >ระบบวินิจฉัยโรคเบื้องต้น</a></li>
<!--                    <li><a class="page-scroll" href="#team">Team</a></li>-->
<!--                    <li><a class="page-scroll" href="#testimonials">Testimonials</a></li>-->
                    <li><a class="page-scroll" href="#contact">ติดต่อเรา</a></li>
                    <li><a data-toggle="modal" data-target="#myModal5"  onclick="loginform();" >เข้าสู่ระบบ</a></li>



                </ul>
            </div>
        </div>
    </nav>
</div>







<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
<!--    <ol class="carousel-indicators">-->
<!--        <li data-target="#inSlider" data-slide-to="0" class="active"></li>-->
<!--        <li data-target="#inSlider" data-slide-to="1"></li>-->
<!--    </ol>-->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption" >
                    <font style="color: white"><h1>เวียงพิงค์รักษาสัตว์<br/>  </h1>
                       <h2>ตรวจ - รักษา<br/>
                        ฉีดวัคซีน - ถ่ายพญาธิ<br/>
                        ป้องกันพยาธิหนอนหัวใจ<br/>
                        ทำหมัน สุนัข - แมว<br/>
                        กำจัดเห็บ - หมัด
                        อาบน้ำ - ตัดขน
                       </h2></font>
                    <font style="color: white"><h5>เปิดบริการ 9.00 - 20.00 น. หยุดทุกวันพุทธ โทร. 053-242417 </h5></font>

                </div>
                <div class="carousel-image wow zoomIn">
                    <img src="img/landing/laptop.png" alt="laptop"/>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>

    </div>

</div>


<section id="features" class="container services">
   
</section>



<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>ติดต่อเรา</h1>
                <h3></h3>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy"><h2>คลินิคเวียงพิงค์รักษาสัตว์</h2></span></strong>
                    <h4>133 หมู่ 2 <br/></h4>
                    <h4>ตำบลฟ้าฮ่าม อำเภอเมืองเชียงใหม่<br/></h4>
                        <h4>จังหวัดเชียงใหม่ 50000<br/></h4>
                    <h4> <abbr title="Phone">Tel:</abbr> (053) 242 417</h4>

                </address>
            </div>
            <div class="col-lg-4">

                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fweingpingvetclinic%2F%3Ffref%3Dts&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                           </div>
        </div>
        <div class="text-center">
      
        
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">

                <ul class="list-inline social-icon">
<!--                    <li><a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                    </li>-->
<!--                    <li><a href="https://www.facebook.com/weingpingvetclinic/?ref=ts&fref=ts"><i class="fa fa-facebook"></i></a>-->
                    </li>
<!--                    <li><a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
<!--                <p><strong>&copy; 2015 Company Name</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam-->
<!--                    veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>-->
            </div>
        </div>
    </div>
</section>


<div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>ClinicWeingPing | Login</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="loginform"></div>

            </div>

            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="myModal6" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>การวินิจฉัยโรคเบื้องต้น</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"></button>
            </div>

            <div class="ibox-content">

                <div id="disease"></div>

            </div>

            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>




<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/wow/wow.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<script src="js/plugins/iCheck/icheck.min.js"></script>
<style>
    .big {
        width: 20px;
        height: 20px;
    }
</style>

<script>


    function loginform() {
        $.ajax({

            type:"POST",
            url:"module/login_form.php",

            success:function (data) {
                $("#loginform").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }

    function disease() {


        $.ajax({

            type:"POST",
            url:"disease.php",

            success:function (data) {
                $("#disease").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }

    $(document).ready(function () {



        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }


        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function (event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 300);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
    });

    var cbpAnimatedHeader = (function () {
        var docElem = document.documentElement,
            header = document.querySelector('.navbar-default'),
            didScroll = false,
            changeHeaderOn = 200;

        function init() {
            window.addEventListener('scroll', function (event) {
                if (!didScroll) {
                    didScroll = true;
                    setTimeout(scrollPage, 250);
                }
            }, false);
        }

        function scrollPage() {
            var sy = scrollY();
            if (sy >= changeHeaderOn) {
                $(header).addClass('navbar-scroll')
            }
            else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }

        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }

        init();

    })();


    function showform(type) {

        var text = "";
        $.ajax({
            type: "POST",
            url: "function_selectType.php?type=" + type,
            data: text,
            cache: false,
            beforeSend: function () {
            },
            success: function (data) {
                $("#results").html(data);

            },
            error: function () {
                alert("error");
            }
        });
        return false;
    }
    function send(no) {

        var text = $("#form").serialize();

        $.ajax({
            type: "POST",
            url: "function_selectType.php?type=disease&pet_type="+no,
            data: text,
            cache: false,
            beforeSend: function () {


            },
            success: function (data) {
                $("#output").html(data);

            },
            error: function () {
                alert("error");
            }
        });
        return false;


    }


</script>

</body>
</html>
