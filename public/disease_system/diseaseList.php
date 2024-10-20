
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


      <div class="modal fade" id="addDiseaseModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content ">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Add Disease</h4>
            </div>
            <div class="modal-body">
            <form class="generic_form_trigger" data-url="disease">
              <input type="hidden" name="action" value="addDisease">
            <div class="form-group">
              <label for="exampleInputEmail1">Disease Name <span class="color-red">*</span></label>
              <input placeholder="Enter Disease Name Here" type="text" class="form-control" name="diseaseName" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Transmission Type <span class="color-red">*</span></label>
              <input placeholder="Enter Transmission Type Here" type="text" class="form-control" name="transmissionType" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description <span class="color-red">*</span></label>
              <textarea name="description" required class="form-control"></textarea>
            </div>


            <div class="form-group">
                        <label>Species Affected <span class="color-red">*</span></label>
                        <select name="speciesAffected" required class="form-control">
                          <option selected disabled value="">Please select option</option>
                          <option value="cat">Cat</option>
                          <option value="dog">Dog</option>
                          <option value="both">Both</option>
                        </select>
                      </div>


            <div class="form-group">
              <label for="exampleInputEmail1">Symptoms <span class="color-red">*</span></label>
              <textarea name="symptoms" required class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Is it Contagious? <span class="color-red">*</span></label>
              <select name="is_contagious" required class="form-control">
                <option selected disabled value="">Please select option</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Treatment <span class="color-red">*</span></label>
              <textarea name="treatment" required class="form-control"></textarea>
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
                <h5 class="m-0">DISEASE LIST
                <a href="#" data-target="#addDiseaseModal" data-toggle="modal" class="btn btn-primary float-right">ADD DISEASE</a>
                </h5>
              </div>
              <div class="card-body table-responsive">
                <br>
                <table class="table table-bordered" id="ajax_datatable">
                  <thead>
                    <th width="10%">Action</th>
                    <th>Disease</th>
                    <th>Transmission Type</th>
                    <th>Description</th>
                    <th>Symptoms</th>
                    <th>Treatment</th>
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
                "ordering": false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'disease',
                     'type': "POST",
                     "data": function (data){
                        data.action = "diseaseRecords";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'name', "orderable": false  },
                    { data: 'transmission_type', "orderable": false  },
                    { data: 'description', "orderable": false  },
                    { data: 'symptoms', "orderable": false  },
                    { data: 'treatment', "orderable": false  },
       
                ],

                dom: 'Bfrtip', // Enable buttons
                buttons: [
        {
            text: 'Export CSV',
            action: function (e, dt, button, config) {
                let searchValue = $('input[type="search"]').val(); // Capture search value
                $.ajax({
                    url: 'disease',
                    type: 'POST',
                    data: {
                        action: 'exportDiseaseRecords', // Export action
                        search: searchValue // Send search term
                    },
                    success: function (response) {
                        let csvData = new Blob([response], { type: 'text/csv;charset=utf-8;' });
                        let link = document.createElement('a');
                        link.href = URL.createObjectURL(csvData);
                        link.setAttribute('download', 'disease_records.csv');
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    },
                    error: function (xhr) {
                        alert('Error fetching data for export!');
                    }
                });
            }
        }
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
