
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">




    <section class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <h5 class="m-0">PENDING SCHEDULE
                  <?php if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"): ?>
                    <a href="#" data-toggle="modal" data-target="#bookDoctor" style="float:right;" class="btn btn-warning">BOOK TO DOCTOR (WALK IN)</a>


          <div class="modal fade" id="bookDoctor">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">BOOK TO DOCTOR</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <!-- <form class="generic_form" url="employees" autocomplete="off"> -->
              <?php $client = query("select * from client order by lastname, firstname"); ?>
              <?php $doctor = query("select * from doctors"); ?>
              <form class="generic_form_trigger" data-url="schedule">
                <input type="hidden" name="action" value="bookSchedule">
              <div class="form-group">
                  <label>Client</label>
                  <select name="clientId" required class="form-control select2" style="width: 100%;">
                    <option selected disabled value="">Please select client</option>
                    <?php foreach($client as $row): ?>
                      <option value="<?php echo($row["clientId"]); ?>"><?php echo($row["lastname"] . ", " . $row["firstname"]); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Doctor</label>
                  <select name="doctorId" required class="form-control select2" style="width: 100%;">
                  <option selected disabled value="">Please select doctor</option>
                  <?php foreach($doctor as $row): ?>
                      <option value="<?php echo($row["doctorsId"]); ?>">Dr. <?php echo($row["doctorsLastname"] . ", " . $row["doctorsFirstname"]); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>
                
                
     
                  </form>
              </div>
            </div>
          </div>
        </div>

                  <?php endif; ?>
                </h5>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th width="15%">Action</th>
                    <th>Client</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Status</th>
                  </thead>
                </table>
              </div>
            </div>
      </div>
    </section>
  </div>
  <?php require("layouts/footer.php") ?>

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


<script>


$('.select2').select2()

  

var datatable = 
            $('#ajax_datatable').DataTable({
                "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Search Doctor's Name"
                },
                "bLengthChange": true,
                "ordering": false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'schedule',
                     'type': "POST",
                     "data": function (data){
                        data.action = "scheduleList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'client', "orderable": false  },
                    { data: 'doctor', "orderable": false  },
                    { data: 'dateScheduled', "orderable": false  },
                    { data: 'status', "orderable": false  },
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
