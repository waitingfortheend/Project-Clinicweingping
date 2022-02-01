<link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">


<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">



            </div>
            <div class="ibox-content">


                <div class="row">

                    <div class="col-md-4">

                        <p class="font-bold">
                            Example with vertical button alignment:
                        </p>
                        <input class="touchspin3" type="text" onchange="percent(value)" name="demo3">
                    </div>


                    <div class="col-md-4">

                        <p class="font-bold">
                            Example with vertical button alignment:
                        </p>
                        <input class="touchspin3" type="text" onchange="percent(value)"  value="" name="demo3">
                    </div>

                    <div class="col-md-4">

                        <p class="font-bold">
                            Example with vertical button alignment:
                        </p>
                        <input class="touchspin3" type="text" onchange="percent(value)" value="" name="demo3">
                    </div>


                </div>
                <?php
                if(empty($chk)){

                $a = 100;
                    $chk=1;
                }
                ?>

                <input class="touchspin3" type="text1"  id="input_percent" name="demo3">


            </div>
        </div>
    </div>
</div>


<script>
    function num1(value) {

        alert(value);

        return num;

    }

    function percent(value1) {

        var strMessage = '<?=$a?>' ;

        var sum =  strMessage - value1;

        $("#input_percent").val(sum);




    }


</script>


<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- TouchSpin -->
<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>


<script>

    $(".touchspin3").TouchSpin({
        verticalbuttons: true,
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });


</script>