
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


<div class="modal fade" id="modalAppointment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Schedule Appointment</h4>
        </div>
        <form class="generic_form_trigger" data-url="appointment">
          <div class="modal-body">
            <div class="fetched-data"></div>
          </div>
        </form>
      </div>
    </div>
</div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <h4 class="m-0">Appointment List
                <!-- <div class="form-group" style="float:right;">
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Book an Appointment</a>
                </div> -->
                </h4>
              </div>
              <div class="card-body table-responsive">

              <!-- <iframe src="https://calendar.google.com/calendar/embed?src=15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2%40group.calendar.google.com&ctz=Asia%2FManila" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe> -->

                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th width="13%">Action</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Note</th>
                    <!-- <th>Meet Link</th> -->
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



$('#modalAppointment').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
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
                    { data: 'email', "orderable": false },
                    { data: 'appointmentStatus', "orderable": false },
                    { data: 'notes', "orderable": false },
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
