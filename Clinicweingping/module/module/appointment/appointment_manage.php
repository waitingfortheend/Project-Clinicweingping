<?php


if(empty($_SESSION['valid_user']) or $_SESSION['login_type']!="Employee" and  $_SESSION['login_type']!="Veterinary" ){
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}


?>


<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">


        <div class="col-lg-3">
            <div class="ibox-content">
                <div id=''>
                    <?php $today = date("Y-m-d");

                    $today2 = date("d-m-y");

                    echo " <p ><font style='font-weight:bold';>ตารางการนัดของวันนี้ : $today2 </font></p>";

                    $sqlap = mysqli_query($conn,"select * from appointment WHERE app_date LIKE '$today%'");




                    while (list($app_id,$pet_id, $app_date, $app_detail) = mysqli_fetch_array($sqlap)) {
                        
                        ?>

                            <center>
                            <button type="button" class="external-event navy-bg"
                                    onclick="detail_app('<?php echo $app_date; ?>');"

                                    data-toggle="modal" data-target="#myModal6">
                                <?php echo "รหัสสัตว์ " . $pet_id . "<br>รายละเอียด<br>" . $app_detail ?>

                            </button>
                            </center>



        <?php

                    }


                    if(mysqli_num_rows($sqlap)<=0){

                        echo "<font style='font-weight: bold;color: red;'>ไม่มีการนัดหมายในวันนี้</font>";
                    }



                    ?>


                </div>
            </div>

        </div>

        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>ตารางนัด </h5>

                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal6" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">

                <h3>รายละเอียดการนัด</h3>
                <button type="button" class="close" data-dismiss="modal"
                        id="form1cacle"><span
                        aria-hidden="true"></button>
            </div>

            <div class="modal-body">

                <div id="detail_app"></div>

            </div>



            <div class="modal-footer">

                <button type="button" id="form1cacle" class="btn btn-danger btn-sm dim"
                        data-dismiss="modal">
                    <i class="fa fa-close"></i>
                    | ปิดหน้าต่าง
                </button>
                <!--                                 <button type="button" class="btn btn-primary">Save changes-->
                <!--                                 </button>-->
            </div>
        </div>
    </div>
</div>

<?php
$count = 0;
$sql_app = mysqli_query($conn,"select * from appointment");
$test1 = "";
$sql = mysqli_query($conn,"select count(pet_id) from appointment");
list($num) = mysqli_fetch_array($sql);

while (list($app_id,$pet_id, $app_date, $app_detail) = mysqli_fetch_array($sql_app)) {

    $thisyear = explode(' ', $app_date);
    $time = explode(':', $thisyear[1]);
    $hour = $time[0];
    $minit = $time[1];


    $date1 = explode('-', $thisyear[0]);
    $year = $date1[0];
    $month = $date1[1];
    $day = $date1[2];


    if ($count < $num) {
        $test1 .= "{   
                
                        title: \"$app_detail\",
                        start: new Date($year, $month-1, $day,$hour,$minit),
                          allDay: false
                        }";
        if ($num - 1 == $count) {
            $test1 .= "";

        } else {
            $test1 .= ",";
        }

    } else {


    }

    $count++;

}


?>


<script>


    function detail_app(app_date) {


        $.ajax({

            type:"POST",
            url:"module/appointment/detail_app.php",
            data:{app_date:app_date},
            success:function (data) {
                $("#detail_app").html(data);

            },
            error:function () {
                alert("error");
            }



        });
        return false;
    }


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    /* initialize the external events
     -----------------------------------------------------------------*/


    $('#external-events div.external-event').each(function () {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 1111999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    /* initialize the calendar
     -----------------------------------------------------------------*/
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        drop: function () {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        events: [

            <?php  echo $test1; ?>
        ]
    });


</script>