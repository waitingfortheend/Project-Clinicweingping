<?php
@session_start();
if (empty($_SESSION['valid_user']) or $_SESSION['login_type'] != "Veterinary") {
    session_destroy();
    echo "<script>alert('คุณไม่สามารถใช้งานหน้านี้ได้')</script>";
    echo "<script>window.location='../index.php'</script>";
}
@include("../../include/connect_db.php");

?>
<form role="form" id="form" method="post" action="index.php?module=disease&action=insert_symptoms"
      class="form-horizontal">
    <div class="form-group"><label class="col-sm-3 control-label ">เลือกเจ้าของสัตว์ </label>

        <div class="col-sm-6">

            <select name="diseasetypeid" data-placeholder="กรุณาเลือก" class="chosen-select form-control" tabindex="2">

                <?php
                $sql_sym = mysqli_query($conn,"select * from diseasetype order by diseasetypeid DESC ");

                while (list($dis_id, $dis_name, $dis_cure, $pet_type) = mysqli_fetch_array($sql_sym)) {

                    if($pet_type==1){
                        $pet_name = "สุนัข";
                    }elseif($pet_type==2){
                        $pet_name = "แมว";
                    }else{
                        $pet_name="";

                    }

                    echo "<option value=$dis_id>รหัส $dis_id ชื่อโรค : $dis_name : $pet_name </option>";


                }

                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label ">อาการโรค</label>
        <div class="col-sm-8">
            <textarea style="height: 100px" name="sym_detail" required placeholder="" class="form-control"></textarea>
        </div>
        <font style="color: red"> * ขั้นด้วย ( , )</font>

    </div>
    <input type="hidden" name="type_pet" required value="<?php echo $pet_type;  ?>" placeholder="" class="form-control">

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-5">
            <button class="btn btn-primary" type="submit" name="submit">บันทึก</button>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
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


        $("#form").validate({
            rules: {
                sym_detail: {
                    required: true,
                    ruleSD: "^[^'\"]+$"
                }

            }, messages: {
                sym_detail: {

                    required: "กรุณากรอกอาการ",
                    ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
                }
            }

        });
    });

</script>