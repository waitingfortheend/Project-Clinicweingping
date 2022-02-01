
               <form method="post" role="form" id="form" action="index.php?module=drug&action=insert_type" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group"><label class="col-sm-3 control-label ">ชื่อประเภทยา</label>
                       <div class="col-sm-8"><input type="text"  name="type_name" placeholder="" class="form-control" required></div>
                  </div>
                  <div class="hr-line-dashed"></div>


                  <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-5">
                           <button class="btn btn-primary" type="submit" name="submit" >บันทึก</button>
                      </div>
                 </div>


               </form>


<script>

    
$(document).ready(function () {

    $("#form").validate({
        rules: {
            type_name: {
                required: true,
                maxlength: "20",
                ruleSD: "^[^'\"]+$"
            }
        },
        messages: {
            type_name: {

                required: "กรุณากรอกชื่อประเภทยา",
                maxlength: "กรุณาระบุตัวอักษรไม่เกิน 20 ตัวอักษร",
                ruleSD: "กรุณาป้อนข้อมูลและงดใช้อักษระ single qoute หรือ double qoute"
            }
        }
    });
});
</script>