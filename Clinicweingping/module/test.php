
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>รายละเอียดการซื้อ <?php echo $buy_id; ?></h5>

                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>

                                       <th>รหัสยา </th>
                                       <th>ชื่อยา </th>
                                       <th>จำนวน</th>
                                       <th>ราคา</th>
                                       <th>ราคารวม</th>

                                </tr>
                                </thead>
                                <tbody>

                                   <?php


                                  $sql_bd = mysqli_query($conn,"select * from buy_detail where buy_id='$buy_id'");



                                  while(list($buy_id,$d_id,$b_price,$b_amount)= mysqli_fetch_array($sql_bd)){

                                     $sum_price = $b_price * $b_amount;
                                  $sql_d = mysqli_query($conn,"select * from drug where d_id='$d_id'");

                                  list($d_id,$d_eng,$d_th,$d_detail,$d_price,$s_price,$amount,$unit,$mfg,$exp,$picture,$type)=mysqli_fetch_array($sql_d); //ดึงข้อมูลจากฐานข้อมูลออกมาครั้งละ 1 แถว

                                  echo " <tr class='gradeA'>
                                       <td>Presto</td>
                                       <td>Opera 9.5</td>
                                       <td>Win 88+ / OSX.3+</td>
                                       <td class='center'>-</td>
                                       <td class='center'>A</td>
                                   </tr>";
                                  ?>


                                  <?php
                                  }

                                  ?>
                                  <tr class="gradeA">
                                      <td>Presto</td>
                                      <td>Opera 9.5</td>
                                      <td>Win 88+ / OSX.3+</td>
                                      <td class="center">-</td>
                                      <td class="center">A</td>
                                  </tr>
                                  <tr class="gradeB">

                                    <td><?php echo "aaaa"; ?></td>
                                    <td>Internet
                                        Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>

                                </tr>





                                </tbody>






                                <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                                </tfoot>
                                </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>


                            <!-- Mainly scripts -->
                            <script src="js/jquery-2.1.1.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
                            <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
                            <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

                            <script src="js/plugins/dataTables/datatables.min.js"></script>

                            <!-- Custom and plugin javascript -->
                            <script src="js/inspinia.js"></script>
                            <script src="js/plugins/pace/pace.min.js"></script>

                            <!-- Page-Level Scripts -->
                            <script>
                                $(document).ready(function(){
                                    $('.example').DataTable({
                                        dom: '<"html5buttons"B>lTfgitp',
                                        buttons: [
                                            { extend: 'copy'},
                                            {extend: 'csv'},
                                            {extend: 'excel', titles: 'ExampleFile'},
                                            {extend: 'pdf', title: 'ExampleFile'},

                                            {extend: 'print',
                                             customize: function (win){
                                                    $(win.document.body).addClass('white-bg');
                                                    $(win.document.body).css('font-size', '10px');

                                                    $(win.document.body).find('table')
                                                            .addClass('compact')
                                                            .css('font-size', 'inherit');
                                            }
                                            }
                                        ]

                                    });

                                    /* Init DataTables */
                                    var oTable = $('#editable').DataTable();

                                    /* Apply the jEditable handlers to the table */
                                    oTable.$('td').editable( '../example_ajax.php', {
                                        "callback": function( sValue, y ) {
                                            var aPos = oTable.fnGetPosition( this );
                                            oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                                        },
                                        "submitdata": function ( value, settings ) {
                                            return {
                                                "row_id": this.parentNode.getAttribute('id'),
                                                "column": oTable.fnGetPosition( this )[2]
                                            };
                                        },

                                        "width": "90%",
                                        "height": "100%"
                                    } );


                                });

                                function fnClickAddRow() {
                                    $('#editable').dataTable().fnAddData( [
                                        "Custom row",
                                        "New row",
                                        "New row",
                                        "New row",
                                        "New row" ] );

                                }
                            </script>
