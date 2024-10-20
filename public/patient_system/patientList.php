
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">


<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <div class="modal fade" id="updatePatientModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content ">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Update Profile</h4>
            </div>
            <div class="modal-body">
            <form class="generic_form_trigger" data-url="patient">
              <input type="hidden" name="action" value="updatePatient">
              <div class="fetched_data"></div>
                <hr>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



        <div class="card">
              <div class="card-header">
                <h5 class="m-0">PET PATIENTS RECORD
                  <a href="profile?action=profileAdd" style="float:right;" class="btn btn-warning">Add New Client</a>
                  <!-- <button class="float-right btn btn-info mr-2" onclick="buttonRedraw();">REDRAW</button> -->
                </h5>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax_datatable" style="width: 100%; table-layout: fixed;">
                  <thead>
                    <th>Action</th>
                    <th >Pet Owner</th>
                    <th >Address</th>
                    <th >Gender</th>
                    <th >Birth Date</th>
                    <th ># of Pets</th>
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
<script src="AdminLTE_new/plugins/inputmask/jquery.inputmask.min.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
  

var datatable = 
            $('#ajax_datatable').DataTable({
                // "searching": false,
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
                    'url':'patient',
                     'type': "POST",
                     "data": function (data){
                        data.action = "patientRecords";
                     }
                },
                'columns': [
                  { data: 'action', "orderable": false, visible: true },  // Initially visible
                  { data: 'name', "orderable": false, visible: true },    // Initially visible
                  { data: 'address', "orderable": false, visible: true }, // Initially visible
                  { data: 'gender', "orderable": false, visible: true }, // Initially hidden
                  { data: 'birthDate', "orderable": false, visible: false }, // Initially hidden
                  { data: 'pets', "orderable": false, visible: true }     // Initially visible
                ],
                
                columnDefs: [
        { width: "10%", targets: 0 }, // Action column
        { width: "30%", targets: 1 }, // Pet Owner
        { width: "30%", targets: 2 }, // Address
        { width: "10%", targets: 3 }, // Gender
        { width: "10%", targets: 4 },  // # of Pets
        { width: "10%", targets: 5 }  // # of Pets
    ],
    "initComplete": function () {
        var api = this.api();
        // Set up column visibility button actions
        $('.column-visibility-button').on('click', function () {
            var column = api.column($(this).data('column'));
            column.visible(!column.visible());
            api.columns.adjust().responsive.recalc(); // Recalculate widths
        });
    },
                dom: 'Bfrtip', // Enable buttons
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            exportOptions: {
                columns: ':visible' // Export only visible columns
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'Export to PDF',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    page: 'current' // Export only the current page data
                }
            }
        },
        {
            extend: 'print',
            text: 'Print',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    page: 'current' // Print only the current page data
                }
            }
        },
        'colvis' // Column visibility button
    ],
    
    responsive: true,
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

          datatable.on('column-visibility.dt', function(e, settings, column, state) {
            // Redraw the DataTable when column visibility changes
            buttonRedraw();
        });

            function buttonRedraw() {
    var datatable = $('#ajax_datatable').DataTable();
    datatable.columns.adjust().responsive.recalc(); // Adjust the DataTable
}

        $('#updatePatientModal').on('show.bs.modal', function (e) {
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
            url : 'patient', //Here you will fetch records 
            data: {
                clientId: rowid ,action: "updatePatientModal"
            },
            success : function(data){
                $('#updatePatientModal .fetched_data').html(data);

                $('[data-mask]').inputmask()
    $('#region_select').select2({
      placeholder: 'Please select Region',
      width: '100%'
    });
    $('#province_select').select2({
      placeholder: 'Please select Province',
      width: '100%'
    });

    $('#city_mun_select').select2({
      placeholder: 'Please select City / Municipality',
      width: '100%'
    });

    $('#barangay_select').select2({
      placeholder: 'Please select Barangay',
      width: '100%'
    });
    





            $('.sampleDatatable').DataTable({
            });


            $(document).ready(function() {
    $('[data-mask]').inputmask();
   
});
                Swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


    



$(function () {
  // $.validator.setDefaults({
  //   submitHandler: function () {
  //     alert( "Form successful submitted!" );
  //   }
  // });
  $(function () {
  $('.generic_form_trigger').validate({
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
});

</script>
