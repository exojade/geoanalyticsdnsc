
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">

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

<div class="content-wrapper">


<div class="modal fade" id="modalAppointment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Schedule Appointment</h4>
        </div>
        <form class="generic_form_trigger" id="AppointmentModalForm" data-url="appointment">
          <div class="modal-body">
            <div class="fetched-data"></div>
          </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="walkInModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Register Walk In</h4>
        </div>
        <form class="generic_form_trigger" id="walkInForm" data-url="appointment">
          <div class="modal-body">
          <?php $client = query("select * from client order by lastname, firstname"); ?>
              <?php $doctor = query("select * from doctors"); ?>
              <form class="generic_form_trigger" data-url="appointment">
                <input type="hidden" name="action" value="walkinAppointment">
              <div class="form-group">
                  <label>Client</label>
                  <select id="selectClientWalkin" name="clientId" required class="form-control select2" style="width: 100%;">
                    <option selected disabled value="">Please select client</option>
                    <?php foreach($client as $row): ?>
                      <option value="<?php echo($row["clientId"]); ?>"><?php echo($row["lastname"] . ", " . $row["firstname"]); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Doctor</label>
                  <select id="selectDoctorWalkIn" name="doctorId" required class="form-control select2" style="width: 100%;">
                  <option selected disabled value="">Please select doctor</option>
                  <?php foreach($doctor as $row): ?>
                      <option value="<?php echo($row["doctorsId"]); ?>">Dr. <?php echo($row["doctorsLastname"] . ", " . $row["doctorsFirstname"]); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                  
                <div id="walkInScheduleDiv">
                  <div class="form-group">
                    <label>Time Schedule</label>
                    <select name="doctorId" required class="form-control" >
                    <option selected disabled value="">Please select Time Schedule</option>
          
                    </select>
                  </div>
                </div>

                <button class="btn btn-primary">Submit</button>



                
          </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="modalAppointmentDetails">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Appointment Details</h4>
        </div>
          <div class="modal-body">
            <div class="fetched-data"></div>
          </div>
      </div>
    </div>
</div>


<div class="modal fade" id="rescheduleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Reschedule Appointment</h4>
        </div>
        <form class="generic_form_trigger" data-url="appointment" id="reScheduleDoctorForm">
          <div class="modal-body">
            <div class="fetched-data"></div>
          </div>
        </form>
      </div>
    </div>
</div>

    <section class="content">
      <div class="container-fluid">

      <!-- <?php
        // dump($_SESSION);
      if($_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"):  
      
        ?>
        <div class="alert alert-info alert-dismissible">
             
                  <h5><i class="icon fas fa-info"></i> Legends for the Action Buttons</h5>
                  <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success">
                          <i class="fas fa-check"> MARK AS DONE</i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning">
                          <i class="fas fa-edit"> RESCHEDULE</i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger">
                          <i class="fas fa-times"> CANCEL</i>
                        </button>
                      </div>

                </div>
      <?php endif; ?> -->

        <div class="card">
              <div class="card-header">
                <h4 class="m-0">Appointment List
                <!-- <div class="form-group" style="float:right;">
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Book an Appointment</a>
                </div> -->
                <a href="#" data-toggle="modal" data-target="#walkInModal" class="btn btn-primary float-right">ADD WALK IN</a>
                </h4>

                
              </div>
              <div class="card-body table-responsive">

              <!-- <iframe src="https://calendar.google.com/calendar/embed?src=15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2%40group.calendar.google.com&ctz=Asia%2FManila" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe> -->

                <table class="table table-bordered table-striped" id="ajax_datatable">

                <?php if($_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"): ?>
                  <thead>
                    <th width="13%">Action</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Meeting</th>
                    <th>Type</th>
                    <!-- <th>Meet Link</th> -->
                  </thead>
                <?php else: ?>
                  <thead>
                    <th width="13%">Action</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Doctor</th>
                    <th>Type</th>
                    <!-- <th>Meet Link</th> -->
                  </thead>
                <?php endif; ?>
                </table>
              </div>
            </div>




      </div>
    </section>
  </div>
  <?php require("layouts/footer.php") ?>
<script src="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
<script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>

<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>
<script>

$('.select2').select2()
$(document).ready(function(){

  $(function () {
  $('#AppointmentModalForm').validate({
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

  $('#walkInForm').validate({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        // For regular inputs
        $(element).addClass('is-invalid').removeClass('is-valid');
        
        // For Select2, apply the invalid class to its container
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').addClass('is-invalid').removeClass('is-valid');
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        // For regular inputs
        $(element).removeClass('is-invalid').addClass('is-valid');
        
        // For Select2, remove the invalid class from its container
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').removeClass('is-invalid').addClass('is-valid');
        }
    },
    success: function (label, element) {
        $(element).addClass('is-valid'); // Adds green border when valid
        // For Select2, add valid styling
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').addClass('is-valid');
        }
    }
});



$('#reScheduleDoctorForm').validate({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        // For regular inputs
        $(element).addClass('is-invalid').removeClass('is-valid');
        
        // For Select2, apply the invalid class to its container
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').addClass('is-invalid').removeClass('is-valid');
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        // For regular inputs
        $(element).removeClass('is-invalid').addClass('is-valid');
        
        // For Select2, remove the invalid class from its container
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').removeClass('is-invalid').addClass('is-valid');
        }
    },
    success: function (label, element) {
        $(element).addClass('is-valid'); // Adds green border when valid
        // For Select2, add valid styling
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2').addClass('is-valid');
        }
    }
});


});







$('#modalAppointment').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    Swal.fire({title: 'Please wait...', 
      
      showClass: {
    popup: `
      animate__animated
      animate__bounceIn
      animate__faster
    `
  },
  hideClass: {
    popup: `
      animate__animated
      animate__bounceOut
      animate__faster
    `
  },
      imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
    $.ajax({
        type : 'post',
        url : 'appointment', //Here you will fetch records 
        data: {
            appointmentId: rowid, action: "modalAppointment"
        },
        success : function(data){
            $('#modalAppointment .fetched-data').html(data);
            Swal.close();
            // $(".select2").select2();//Show fetched data from database
        }
    });
  });


  $(document).on('change', 'select[name="doctorId"], input[name="appointment_date"]', function() {
    var doctorId = $('select[name="doctorId"]').val();
    var dateSet = $('input[name="appointment_date"]').val(); // Assuming you have an input for the date
    var appointmentId = $('input[name="appointmentId"]').val();
    // alert(dateSet);
    // Check if both doctorId and dateSet are selected
    if (doctorId && dateSet) {
        $.ajax({
            type: 'post',
            url: 'appointment', // Here you will fetch records 
            data: {
                doctorId: doctorId, 
                dateSet: dateSet, // Include the selected date
                appointmentId: appointmentId, 
                action: "checkDoctorSchedule"
            },
            success: function(data) {
                $('#modalAppointment #timeSlotDiv').html(data);
                Swal.close();
                // $(".select2").select2(); // Show fetched data from database
            }
        });
    }
});







function doctorRescheduleFunction(){
  var dateSet = $('input[name="appointment_date"]').val(); // Assuming you have an input for the date
    var appointmentId = $('input[name="appointmentId"]').val();
    // alert(dateSet);
    // Check if both doctorId and dateSet are selected
    if (dateSet) {
        $.ajax({
            type: 'post',
            url: 'appointment', // Here you will fetch records 
            data: {
                dateSet: dateSet, // Include the selected date
                appointmentId: appointmentId, 
                action: "checkDoctorRESchedule"
            },
            success: function(data) {
                $('#rescheduleModal #timeSlotDiv').html(data);
                Swal.close();
                // $(".select2").select2(); // Show fetched data from database
            }
        });
    }
}



$(document).on('change', 'input[id="reSchedDoctorAppointmentDate"]', function() {
  doctorRescheduleFunction();
});







// $(document).ready(function() {
$(document).on('change', '#selectDoctorWalkIn', function() {
    var doctorId = $('#selectDoctorWalkIn').val();
    // alert(doctorId)
    if (doctorId) {
        $.ajax({
            type: 'post',
            url: 'appointment', // Here you will fetch records 
            data: {
                doctorId: doctorId, 
                action: "checkDoctorScheduleWalkin"
            },
            success: function(data) {
                $('#walkInModal #walkInScheduleDiv').html(data);
                Swal.close();
                // $(".select2").select2(); // Show fetched data from database
            }
        });
    }
});
// });



  $('#rescheduleModal').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    Swal.fire({title: 'Please wait...', 
      showClass: {
    popup: `
      animate__animated
      animate__bounceIn
      animate__faster
    `
  },
  hideClass: {
    popup: `
      animate__animated
      animate__bounceOut
      animate__faster
    `
  },
      imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
    $.ajax({
        type : 'post',
        url : 'appointment', //Here you will fetch records 
        data: {
            appointmentId: rowid, action: "rescheduleModal"
        },
        success : function(data){
            $('#rescheduleModal .fetched-data').html(data);
            doctorRescheduleFunction();
            Swal.close();
            // $(".select2").select2();//Show fetched data from database
        }
    });
  });


  $('#modalAppointmentDetails').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    Swal.fire({title: 'Please wait...',
      showClass: {
    popup: `
      animate__animated
      animate__bounceIn
      animate__faster
    `
  },
  hideClass: {
    popup: `
      animate__animated
      animate__bounceOut
      animate__faster
    `
  },
      imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
    $.ajax({
        type : 'post',
        url : 'appointment', //Here you will fetch records 
        data: {
            appointmentId: rowid, action: "modalAppointmentDetails"
        },
        success : function(data){
            $('#modalAppointmentDetails .fetched-data').html(data);
            Swal.close();
            // $(".select2").select2();//Show fetched data from database
        }
    });
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
                    'url':'appointment',
                     'type': "POST",
                     "data": function (data){
                        data.action = "appointmentList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'client', "orderable": false },
                    { data: 'dateSet', "orderable": false },
                    { data: 'timeSet', "orderable": false },
                    { data: 'appointmentStatus', "orderable": false },
                    { data: 'doctor', "orderable": false },
                    { data: 'type', "orderable": false },

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

</script> 
