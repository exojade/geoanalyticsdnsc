  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>MTOP List</h1>
          </div>
     
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            
            <div class="card">
              <div class="card-body">
                <table id="mtop_datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th rowspan="2">MTOP</th>
                    <th rowspan="2">Fullname</th>
                    <th rowspan="2">Gender</th>
                    <th rowspan="2">Address</th>
                    <th colspan="2">Expiration</th>
                  </tr>
                  <tr>
                    <th>Mayor's Permit</th>
                    <th>Franchise</th>
                  </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
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
  $(function () {
    // $("#mtop_datatable").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });


  $(function () {
    var datatable = 
            $('#mtop_datatable').DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false,
              "buttons": ["colvis"],
                // "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Enter Filter"
                },
                "bLengthChange": false,
                "ordering": false,
                // "info":     false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'mtop_profile',
                     'type': "POST",
                     "data": function (data){
                        data.action = "mtop_datatable";
                     }
                },
                'columns': [
                    { data: 'mtop', "orderable": false },
                    { data: 'fullname', "orderable": false },
                    { data: 'gender', "orderable": false },
                    { data: 'address', "orderable": false  },
                    { data: 'mp_expiration_date', "orderable": false  },
                    { data: 'expiration_date', "orderable": false  },
                ],
                "footerCallback": function (row, data, start, end, display) {
                
                }
            }).buttons().container().appendTo('#mtop_datatable_wrapper .col-md-6:eq(0)');
   
  })



</script>


  <?php require("layouts/footer.php") ?>