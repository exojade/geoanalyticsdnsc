
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">

<?php $pet = query("select * from pet where petId = ?", $_GET["id"]); ?>

<?php
$pet = $pet[0];
?>


<div class="modal fade" id="modalNewPet">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Update Pet</h4>
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

    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if($pet["image"] == ""): ?>
                    <?php if($pet["petType"] == "Cat"): ?>
                      <img class="profile-user-img img-fluid img-circle"
                       src="uploads/catVector.jpeg">
                    <?php else: ?>
                      <img class="profile-user-img img-fluid img-circle"
                       src="uploads/dogVector.jpeg">
                    <?php endif; ?>
                    <?php else: ?>
                      <img class="profile-user-img img-fluid img-circle" src="<?php echo($pet["image"]); ?>">
                  <?php endif; ?>
                  
                </div>

                <h3 class="profile-username text-center"><?php echo($pet["petName"]); ?></h3>
                <p class="text-muted text-center"><?php echo($pet["petType"]); ?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About The Pet</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong> Breed</strong>

                <p class="text-muted">
                 <?php echo($pet["petBreed"]); ?>
                </p>

                <hr>
                <strong>Description</strong>
                  <p class="text-muted"><?php echo($pet["petDescription"]); ?></p>
                <hr>
                <strong> Owner</strong>
                <p class="text-muted"><?php echo($pet["petDescription"]); ?></p>
                <hr>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Medical History</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                  <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <table class="table table-bordered table-hover sampleDatatable">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Symptoms</th>
                    <th>Diagnosis</th>
                    <th>Doctor's Diagnosis</th>
                    <th>Prescription</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>May 07, 2024 10:08 PM</td>
                    <td>Suka Kalibanga</td>
                    <td>Parvo</td>
                    <td>Dapat paimnon ug tambal then dili ipadehydrate</td>
                    <td>Medicine X, Injection Y</td>
                  </tr>
                  
                  </tfoot>
                </table>
                  </div>
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


<script>
  


            $('.sampleDatatable').DataTable({
            });

</script> 
