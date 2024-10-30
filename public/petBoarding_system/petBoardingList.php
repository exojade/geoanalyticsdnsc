
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">
<style>
  #sectionTable td{
    border: 0px;
    padding: 0px;
  }
  #sectionTable th{
    border: 0px;
    padding: 0px;
  }
</style>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pet Boarding</h1>
          </div>

          <div class="col-sm-6">
            <!-- <a href="#" data-toggle="modal" data-target="#modalNewBoardUser" class="btn btn-primary float-right">ADD NEW</a> -->
          </div>
    
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <div class="modal fade" id="modalNewBoardUser">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">Add New Pet Boarding</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <form class="generic_form_trigger" url="petBoarding" autocomplete="off" id="newPetboardingForm">
                    <input type="hidden" name="action" value="newPetBoarding">
                    <input type="hidden" name="role" value="user">


                    <div class="row">
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date of Check In <span class="text-red">*</span></label>
                        <input type="date" name="dateCheckIn" class="form-control" id="exampleInputEmail1" required>
                      </div>

                      </div>
                      <div class="col-6">

                      <div class="bootstrap-timepicker">
                          <div class="form-group">
                              <label>Time Check In <span class="text-red">*</span></label>
                              <div class="input-group date" id="timepickerIn" data-target-input="#timepickerInInput">
                                  <input required name="checkin" placeholder="Select Time" type="text" id="timepickerInInput" class="form-control datetimepicker-input" data-target="#timepickerIn" data-toggle="datetimepicker"/>
                                  <div class="input-group-append">
                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date of Check Out <span class="text-red">*</span></label>
                        <input type="date" name="dateCheckOut" class="form-control" id="exampleInputEmail1" required>
                      </div>

                      </div>
                      <div class="col-6">

                      <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time Check Out <span class="text-red">*</span></label>
                            <div class="input-group date" id="timepickerOut" data-target-input="#timepickerOutInput">
                                <input required name="checkout" placeholder="Select Time" type="text" id="timepickerOutInput" class="form-control datetimepicker-input" data-target="#timepickerOut" data-toggle="datetimepicker"/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- /.form group -->
                </div>
                      </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Number of Pets to Board <span class="text-red">*</span></label>
                    <input required name="numberPets" type="number" min="1" max="10" step="1" class="form-control" id="exampleInputEmail1" placeholder="Enter number of pets, Max of 10">
                  </div>
                    
                    

                  
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                        <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button> -->
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>






        <div class="modal fade" id="modalNewBoardAdmin">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">Add New Pet Boarding</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <form class="generic_form_trigger" url="petBoarding" autocomplete="off" id="newPetboardingForm">
                    <input type="hidden" name="action" value="newPetBoarding">
                    <input type="hidden" name="role" value="user">


                    <select id="petOwnerSelectRegister" class="form-control selectFilter" style="width: 100%;">
                          <option></option>
                          <?php foreach($client as $row): ?>
                              <option value="<?php echo($row["clientId"]); ?>"><?php echo($row["lastname"] . ", " . $row["firstname"]); ?></option>
                          <?php endforeach; ?>
                        </select>

                        <br>


                    <div class="row">
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date of Check In <span class="text-red">*</span></label>
                        <input type="date" name="dateCheckIn" class="form-control" id="exampleInputEmail1" required>
                      </div>

                      </div>
                      <div class="col-6">

                      <div class="bootstrap-timepicker">
                          <div class="form-group">
                              <label>Time Check In <span class="text-red">*</span></label>
                              <div class="input-group date" id="timepickerIn" data-target-input="#timepickerInInput">
                                  <input required name="checkin" placeholder="Select Time" type="text" id="timepickerInInput" class="form-control datetimepicker-input" data-target="#timepickerIn" data-toggle="datetimepicker"/>
                                  <div class="input-group-append">
                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <!-- /.form group -->
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date of Check Out <span class="text-red">*</span></label>
                        <input type="date" name="dateCheckOut" class="form-control" id="exampleInputEmail1" required>
                      </div>

                      </div>
                      <div class="col-6">

                      <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time Check Out <span class="text-red">*</span></label>
                            <div class="input-group date" id="timepickerOut" data-target-input="#timepickerOutInput">
                                <input required name="checkout" placeholder="Select Time" type="text" id="timepickerOutInput" class="form-control datetimepicker-input" data-target="#timepickerOut" data-toggle="datetimepicker"/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- /.form group -->
                </div>
                      </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Number of Pets to Board <span class="text-red">*</span></label>
                    <input required name="numberPets" type="number" min="1" max="10" step="1" class="form-control" id="exampleInputEmail1" placeholder="Enter number of pets, Max of 10">
                  </div>
                    
                    

                  
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                        <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button> -->
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>



    <div class="modal fade" id="modalPetBoardingApprove">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
      
					    <h3 class="modal-title text-center">Approve Pet Boarding</h3>
              </div>
              <form class="generic_form_trigger" data-url="petBoarding" style="display: inline;">
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <!-- <form class="generic_form" url="employees" autocomplete="off"> -->
                    <div class="fetched-data"></div>
                    <br>
                    <br>
                      <div class="modal-footer">
                        <button class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                        
                          <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button> -->
                      </div>
                  <!-- </form> -->
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="modalUpdatePetBoarding">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-warning">
					    <h3 class="modal-title text-center">Update Pet Boarding Schedule</h3>
              </div>
              <form class="generic_form_trigger" data-url="petBoarding" style="display: inline;">
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <!-- <form class="generic_form" url="employees" autocomplete="off"> -->
                    <div class="fetched-data"></div>
                    <br>
                    <br>
                      <div class="modal-footer">
                        <button class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                        
                          <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button> -->
                      </div>
                  <!-- </form> -->
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="modalPetBoardingDetails">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
      
					    <h3 class="modal-title text-center">Approve Pet Boarding</h3>
              </div>
              <!-- <form class="generic_form_trigger" data-url="petBoarding" style="display: inline;"> -->
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <!-- <form class="generic_form" url="employees" autocomplete="off"> -->
                    <div class="fetched-data"></div>
                    <br>
                    <br>
                      <div class="modal-footer">
                        <button class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                        
                        <!-- </form> -->
                        <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button> -->
                      </div>
                  <!-- </form> -->
              </div>
            </div>
          </div>
        </div>


    <section class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <!-- <label>Pet Owner</label> -->
                        <select id="petOwnerSelect" class="form-control selectFilter" style="width: 100%;">
                          <option></option>
                          <?php foreach($client as $row): ?>
                              <option value="<?php echo($row["clientId"]); ?>"><?php echo($row["lastname"] . ", " . $row["firstname"]); ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <!-- <label>From</label> -->
                        <input type="date"  class="form-control selectFilter" id="fromDate" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <!-- <label>To</label> -->
                      <input type="date"  class="form-control selectFilter" id="toDate" placeholder="Enter email">
                    </div>
                  </div>

                  <div class="col-md-5">

    
                    
                    <?php if($_SESSION["dnsc_geoanalytics"]["role"] != "admin"): ?>
                      <a href="#" data-toggle="modal" data-target="#modalNewBoardUser" class="btn btn-primary float-right">ADD NEW</a>
                    <?php else: ?>
                      <a href="#" data-toggle="modal" data-target="#modalNewBoardAdmin" class="btn btn-primary float-right">ADD NEW</a>
                    <?php endif; ?>
                  </div>


     

           
                </div>
           
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th>Action</th>
                    <th>Client</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Pets</th>
                    <th>Status</th>
                    <!-- <th>Diagnosis</th> -->
                    <!-- <th>Treatment</th> -->
                    <!-- <th>Disease</th> -->
                  </thead>
                </table>
              </div>
            </div>
      </div>
    </section>
  </div>
  <?php require("layouts/footer.php") ?>
  <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="AdminLTE_new/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="AdminLTE_new/plugins/moment/moment.min.js"></script>
<script src="AdminLTE_new/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- <script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script> -->

<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>


<script>


$('#timepickerIn').datetimepicker({
      format: 'hh:mm A',
      stepping: 60,
      // defaultDate: moment('2024-01-08T12:00:00'),
      // useCurrent: false
    })
    $('#timepickerOut').datetimepicker({
    format: 'hh:mm A',
    stepping: 60,
    // defaultDate: moment('2024-01-08T12:00:00'),
    // useCurrent: false
});



$('#petOwnerSelect').select2({
  placeholder: 'Please select Owner'
    })

    $('#petOwnerSelectRegister').select2({
  placeholder: 'Please select Owner'
    })
    


    $('#modalPetBoardingApprove').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'petBoarding', //Here you will fetch records 
            data: {
                petBoardingId: rowid, action: "modalPetBoardingApprove"
            },
            success : function(data){
                $('#modalPetBoardingApprove .fetched-data').html(data);
                Swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


     $('#modalPetBoardingDetails').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'petBoarding', //Here you will fetch records 
            data: {
                petBoardingId: rowid, action: "modalPetBoardingDetails"
            },
            success : function(data){
                $('#modalPetBoardingDetails .fetched-data').html(data);
                Swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


     



  

var datatable = 
            $('#ajax_datatable').DataTable({
                "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Search Pet Name"
                },
                "bLengthChange": true,
                "ordering": false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'petBoarding',
                     'type': "POST",
                     "data": function (data){
                        data.action = "petBoardingList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'client', "orderable": false  },
                    { data: 'from_date', "orderable": false  },
                    { data: 'to_date', "orderable": false  },
                    { data: 'numberPets', "orderable": false  },
                    { data: 'display_status', "orderable": false },
                    //{ data: 'diagnosis', "orderable": false  },
                    //{ data: 'treatment', "orderable": false  },
                    //{ data: 'disease', "orderable": false  },
                ],
                "footerCallback": function (row, data, start, end, display) {
                    // var api = this.api(), data;
                    

                    // Remove the formatting to get integer data for summation
                    // var intVal = function (i) {
                    //     return typeof i === 'string' ?
                    //         i.replace(/[\$,]/g, '') * 1 :
                    //         typeof i === 'number' ?
                    //             i : 0;
                    // };

                    // // Total over all pages
                    // received = api
                    //     .column(5)
                    //     .data()
                    //     .reduce(function (a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);
                    //     console.log(received);

                    // $('#currentTotal').html('$ ' + received.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                }
            });




  $('.selectFilter').on('change', function() {
    // alert("change");
  var petOwnerSelect = $('#petOwnerSelect').select2('data');
  var petOwner = '';
  if (petOwnerSelect[0]) {
      clientId = petOwnerSelect[0].id;
  }
  // alert(id);
  var from = $('#fromDate').val();
  var to = $('#toDate').val();
  // var type = $('#typeSelect').val();

  // var type = $('#typeSelect').val() || "";
  // var service = $('#serviceSelect').val() || "";
  // var service = $('#serviceSelect').val();






            datatable.ajax.url('medical?action=medicalRecordMasterList&clientId=' + clientId+'&from='+from+'&to='+to+'&service='+service+'&type='+type).load();
});


// $('.selectFilter').on('input change', function() {
//     alert("change");
//     // Your code logic here
// });





$(function () {
  $('#newPetboardingForm').validate({
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid').addClass('is-valid');
    },
    success: function (label, element) {
      $(element).addClass('is-valid'); // Adds green border when valid
      // Add a green check icon or any valid styling you want to apply
      $(element).closest('.form-group').find('span.valid-feedback').remove();
      // $(element).closest('.form-group').append('<span class="valid-feedback">✓</span>'); // Adds a check mark
    }
  });
});


</script>
