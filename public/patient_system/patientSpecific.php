<?php
$client = query("select * from client where clientId = ?", $_GET["id"]);
$client = $client[0];
$pets = query("select *, CONCAT(
  FLOOR(DATEDIFF(CURRENT_DATE(), pet.petDob) / 365), ' years, ',
  FLOOR((DATEDIFF(CURRENT_DATE(), pet.petDob) % 365) / 30), ' months, ',
  DATEDIFF(CURRENT_DATE(), pet.petDob) % 30, ' days'
) AS petAge from pet where clientId = ?", $_GET["id"]);

?>


  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
    <section class="content">
      <div class="container-fluid">


      <div class="modal fade" id="modalNewPet">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Add New Pet</h4>
              </div>
              <form class="generic_form_trigger" data-url="pets" id="AddNewPetForm">
              <div class="modal-body">
                <input type="hidden" name="action" value="addNewPet">
                <input type="hidden" name="clientId" value="<?php echo($_GET["id"]); ?>">
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


              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth <span class="color-red">*</span></label>
                  <input required type="date" name="petDob" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red">*</span></label>
                  <select required class="form-control" name="petGender">
                  <option value="" selected disabled>Please select gender of pet</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
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
                      <p class="help-block">Upload Image of Pet Here!</p>
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







        <div class="modal fade" id="modalUpdatePet">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Update Pet Information</h4>
              </div>
              <form class="generic_form_trigger" data-url="pets" id="updatePetForm">
              <div class="modal-body">
                <input type="hidden" name="action" value="updatePet">
                <div class="fetched-data"></div>
 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>


      <div class="row">
          <div class="col-md-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pet Owner's Information</h3>
              </div>
    
                <div class="card-body">
                  <div class="row">
                  
                    <div class="col-md-12">
                    <table class="table" id="sectionTable">
                    <tr>
                      <th>Owner's Name:</th>
                      <td><?php echo($client["lastname"] . " " . $client["nameExtension"] .  ", " . $client["firstname"] . " " . $client["middlename"]); ?></td>
                      <th>Gender:</th>
                      <td><?php echo($client["gender"]); ?></td>
                    </tr>
                    <tr>
                      
                      <!-- <th>School Year:</th>
                      <td>2023-2024</td> -->
                    </tr>
                    <tr>
                    <th>Contact Number:</th>
                      <td><?php echo($client["contactNumber"]); ?></td>
                      <th>Address:</th>
                      <td><?php echo($client["province"] . ", " . $client["cityMun"] . ", " . strtoupper($client["barangay"]) . ", " . $client["address"]); ?></td>
                    </tr>
                  </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
              <a style="float:right;" class="btn btn-warning" data-target="#modalNewPet" data-toggle="modal">ADD NEW PET</a>
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Pets</a></li>
                  
                  <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th width="7%">Action</th>
                    <th>Pet Name</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Gender</th>
                    <th>Pet Age</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach($pets as $row): ?>
                    <tr>
                      <td>
                      <div class="btn-group btn-block" style="width: 100%;">
                        <a href="pets?action=specific&id=<?php echo($row["petId"]); ?>" class="btn btn-info">Visit</a>
                        <a href="#" data-id="<?php echo($row["petId"]); ?>" data-toggle="modal" data-target="#modalUpdatePet" class="btn btn-warning">Update</a>
                      </div>
                        <!-- <a   class="btn btn-primary btn-block">View</a> -->
                      </td>
                      <td><?php echo($row["petName"]); ?></td>
                      <td><?php echo($row["petType"]); ?></td>
                      <td><?php echo($row["petBreed"]); ?></td>
                      <td><?php echo($row["petGender"]); ?></td>
                      <td><?php echo($row["petAge"]); ?></td>
                      <td><?php echo($row["petDescription"]); ?></td>
                    </tr>
                  <?php endforeach; ?>
                 
                  </tbody>
                </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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

<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>


<script>
  
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
var datatable = 
            $('#ajax_datatable').DataTable({
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
                    { data: 'action', "orderable": false },
                    { data: 'name', "orderable": false  },
                    { data: 'address', "orderable": false  },
                    { data: 'gender', "orderable": false  },
                    { data: 'pets', "orderable": false  },
                ],
                "footerCallback": function (row, data, start, end, display) {
          
                }
            });



$(function () {
    $('#AddNewPetForm').validate({
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
        $(element).closest('.form-group').find('span.valid-feedback').remove();
      }
    });



});


$(function () {
    $('#updatePetForm').validate({
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








$('#modalUpdatePet').on('show.bs.modal', function (e) {
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
                petId: rowid ,action: "modalUpdatePet"
            },
            success : function(data){
                $('#modalUpdatePet .fetched-data').html(data);
                Swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


</script>
