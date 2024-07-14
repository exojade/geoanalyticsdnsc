
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
            <h1>MEDICAL RECORDS MASTERLIST</h1>
          </div>
    
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="medicalRecordModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
      
					    <h3 class="modal-title text-center">Medical Record</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <!-- <form class="generic_form" url="employees" autocomplete="off"> -->
                    <div class="fetched-data"></div>
                    <br>
                    <br>
                      <div class="box-footer">
                        <button class=" btn btn-primary btn-flat pull-right" data-dismiss="modal" aria-label="Close">Close</button>
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
                      <label>Pet Owner</label>
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
                      <label>From</label>
                        <input type="date"  class="form-control selectFilter" id="fromDate" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>To</label>
                      <input type="date"  class="form-control selectFilter" id="toDate" placeholder="Enter email">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Type</label>
                        <select id="typeSelect" class="form-control selectFilter" style="width: 100%;">
                          <option disabled selected value="" disabled>Select Type</option>
                          <option value="Walk-in">Walk-in</option>
                          <option value="Online">Online</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Service</label>
                        <select id="serviceSelect" class="form-control selectFilter" style="width: 100%;">
                          <option disabled selected value="" disabled>Select Service</option>
                          <option value="Checkup">Checkup</option>
                          <option value="Vaccination">Vaccination</option>
                          <option value="Anti Rabies">Anti Rabies</option>
                        </select>
                    </div>
                  </div>
                </div>
           
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th>Action</th>
                    <th>Owner</th>
                    <th>Pet</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Service</th>
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
<!-- <script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script> -->


<script>




$('#petOwnerSelect').select2({
  placeholder: 'Please select Owner'
    })


    $('#medicalRecordModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'medical', //Here you will fetch records 
            data: {
                checkupId: rowid, action: "medicalRecordModal"
            },
            success : function(data){
                $('#medicalRecordModal .fetched-data').html(data);
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
                    'url':'medical',
                     'type': "POST",
                     "data": function (data){
                        data.action = "medicalRecordMasterList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'owner', "orderable": false  },
                    { data: 'pet', "orderable": false  },
                    { data: 'dateCheckup', "orderable": false  },
                    { data: 'type', "orderable": false  },
                    { data: 'service', "orderable": false },
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

  var type = $('#typeSelect').val() || "";
  var service = $('#serviceSelect').val() || "";
  // var service = $('#serviceSelect').val();






            datatable.ajax.url('medical?action=medicalRecordMasterList&clientId=' + clientId+'&from='+from+'&to='+to+'&service='+service+'&type='+type).load();
});


// $('.selectFilter').on('input change', function() {
//     alert("change");
//     // Your code logic here
// });





</script>
