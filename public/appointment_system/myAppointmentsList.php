
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">


<div class="modal fade" id="modalNewPet">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Book an Appointment</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="myAppointments">
              <div class="modal-body">
                <input type="hidden" name="action" value="addNewAppointment">
              <div class="row">
              <div class="col-md-12">

              <label for="exampleInputEmail1">Date of Appointment <span class="color-red">*</span></label><br>
              <div class="input-group">
              
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input placeholder="Select Date of Appointment here" required type="text" data-date-format="yyyy-mm-dd" name="appointment_date" class="form-control" id="datepicker">
              
                </div>
                <br>
              
              <!-- <div class="form-group">
                <label>Date:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  
                </div>
              </div> -->
              <div class="fetched-data"></div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Summary Note of Appointment</label>
                  <textarea required name="noteAppointment" class="form-control" rows="3" placeholder="Reason of Appointment"></textarea>
                </div>
              </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <h4 class="m-0">My Appointment Schedules
                <div class="form-group" style="float:right;">
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Book an Appointment</a>
                </div>
                </h4>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th>Action</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Meet Link</th>
                  </thead>
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
<script>


$(document).ready(function(){

  $('#datepicker').datepicker({
    todayHighlight: true,
    daysOfWeekDisabled: [0, 6], // Disable Sunday (0) and Saturday (6)
    startDate: new Date(),
    beforeShowDay: function(date) {
        // Convert date to MM/DD/YYYY format
        var dateString = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
        // Disable specific dates
        var disabledDates = ['07/28/2021', '07/29/2021', '07/30/2021'];
        // Disable weekends (Saturday and Sunday)
        if (date.getDay() == 0 || date.getDay() == 6 || disabledDates.includes(dateString)) {
            return {
                enabled: false,
                classes: 'disabled-date'
            };
        }
        return {
            enabled: true
        };
    },
    beforeShowMonth: function(date) {
        // Disable December
        if (date.getMonth() === 11) {
            return false;
        }
    }
});


});


$("#datepicker").datepicker({
		onSelect: function(dateText) {
		  display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
		  $(this).change();
		}
	  }).on("change", function() {
		// var date = $(this).datepicker('getDate');
		var date = $("#datepicker").val();
		// type = $( "#type_transaction option:selected" ).val();
		Swal.fire({title: "Please wait...", imageUrl: "AdminLTE_new/dist/img/loader.gif", showConfirmButton: false});
		  $.ajax({
				type : 'post',
				url : 'appointment',
				data :  'the_date='+date+'&action=availSchedules',
				success : function(data){
				  this_checked = 0;
				  // $('#submiter').prop('disabled', true);
				  $('#modalNewPet .fetched-data').html(data);
				  swal.close();
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
                    'url':'myAppointments',
                     'type': "POST",
                     "data": function (data){
                        data.action = "myAppointmentsList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'appointmentDate', "orderable": false  },
                    { data: 'appointmentStatus', "orderable": false  },
                    { data: 'notes', "orderable": false  },
                    { data: 'meetId', "orderable": false  },
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
