
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">


<div class="modal fade" id="modalNewPet">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Add New Pet</h4>
              </div>
              <form class="generic_form_trigger" data-url="pets">
              <div class="modal-body">
                <input type="hidden" name="action" value="addNewPet">
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pet Name <span class="color-red">*</span></label>
                  <input required type="text" name="petName" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Type of Pet <span class="color-red">*</span></label>
                  <select required class="form-control" name="typePet">
                  <option value="" selected disabled>Please select type of pet</option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="exampleInputEmail1">Breed <span class="color-red">*</span></label>
                  <input required type="text" name="petBreed" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Pet Description</label>
                  <textarea name="petDescription" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputFile">Image of Pet</label>
                      <br>
                      <input name="petImage"  type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload death certificate here!</p>
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
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Add New Pet</a>
                </div>
                </h4>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th>Action</th>
                    <th>Appointment Date</th>
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
                    { data: 'petName', "orderable": false  },
                    { data: 'petType', "orderable": false  },
                    { data: 'petBreed', "orderable": false  },
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
