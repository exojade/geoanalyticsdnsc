
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/summernote/summernote-bs4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">


      <div class="modal fade" id="addAnnouncementModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content ">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Add Announcement</h4>
            </div>
            <div class="modal-body">
            <form class="generic_form_trigger" data-url="announcement">
              <input type="hidden" name="action" value="addAnnouncement">
            <div class="form-group">
              <label for="exampleInputEmail1">Title <span class="color-red">*</span></label>
              <input placeholder="Enter Title Here..." type="text" class="form-control" name="title" required>
            </div>
         
            <div class="form-group">
              <label for="exampleInputEmail1">Description <span class="color-red">*</span></label>
              <textarea placeholder="Enter Text Here ..." name="description" required class="form-control"></textarea>
            </div>

            <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input required type="file" class="custom-file-input" name="banner_image" id="exampleInputFile" accept="image/*">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>


     
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
                <h5 class="m-0">Announcement
                <a href="#" data-target="#addAnnouncementModal" data-toggle="modal" class="btn btn-primary float-right">ADD ANNOUNCEMENT</a>
                </h5>
              </div>
              <div class="card-body table-responsive">
                <br>
                <table class="table table-bordered" id="ajax_datatable" style="width: 100%; table-layout: fixed;">
                  <thead>
                    <th>Action</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
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
<script src="AdminLTE_new/plugins/summernote/summernote-bs4.min.js"></script>

<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>

<script src="AdminLTE_new/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<script>
  
  $('.summernote').summernote()
var datatable = 
            $('#ajax_datatable').DataTable({
                // "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Search Data"
                },
                "bLengthChange": true,
                dom: 'Brfltip',
                "ordering": false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'announcement',
                     'type': "POST",
                     "data": function (data){
                        data.action = "announcementList";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false, visible: true },
                    { data: 'title', "orderable": false, visible: true  },
                    { data: 'description', "orderable": false, visible: true  },
                    { data: 'status', "orderable": false, visible: true  },
                    { data: 'status', "orderable": false, visible: true  },
       
                ],
    //             columnDefs: [
    //     { width: "4%", targets: 0 }, // Action column
    //     { width: "20%", targets: 1 }, // Pet Owner
    //     { width: "10%", targets: 2 }, // Address
    //     { width: "10%", targets: 3 }, // Gender
    //     { width: "10%", targets: 4 }, // Gender
    //     { width: "10%", targets: 5 },  // # of Pets
    //     { width: "10%", targets: 6 },  // # of Pets
    //     { width: "10%", targets: 7 }  // # of Pets
    // ],
    "initComplete": function () {
        var api = this.api();
        // Set up column visibility button actions
        $('.column-visibility-button').on('click', function () {
            var column = api.column($(this).data('column'));
            column.visible(!column.visible());
            api.columns.adjust().responsive.recalc(); // Recalculate widths
        });
    },

                buttons: [
                  {
        extend: 'excelHtml5',
        text: 'Export to Excel',
        title: 'Disease List',
        exportOptions: {
            columns: ':visible', // Export only visible columns
            format: {
                body: function (data, row, column, node) {
                    return data; // Modify this if you need custom formatting
                }
            }
        },
        filename: 'Disease List' // Set your custom filename here
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
        // {
        //     extend: 'print',
        //     text: 'Print',
        //     orientation: 'landscape',
        //     exportOptions: {
        //         columns: ':visible',
        //         modifier: {
        //             page: 'current' // Print only the current page data
        //         }
        //     }
        // },
        'colvis' // Column visibility button
    ],



    footerCallback: function (row, data, start, end, display) {
        // Your footer logic here if needed
    }
            });
            

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


</script>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
