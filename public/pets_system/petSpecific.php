
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">

<?php $pet = query("select * from pet where petId = ?", $_GET["id"]); ?>
<?php $medicalRecords = query("select * from checkup where petId = ? order by dateCheckup desc", $_GET["id"]); ?>

<?php $diseases = query("select * from disease"); ?>

<?php $disease = query("select * from checkup_disease cd  
                          left join disease d
                          on d.diseaseId = cd.diseaseId
                          where petId = ?", $_GET["id"]); ?>

<?php
$Disease = [];
foreach($disease as $row):
  $Disease[$row["checkupId"]][$row["diseaseId"]] = $row["diseaseName"];
endforeach; ?>

<?php
$pet = $pet[0];
?>


<div class="modal fade" id="modalNewMedical">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">New Medical Record</h4>
              </div>
              <form class="generic_form_trigger" data-url="medical">
              <div class="modal-body">
                <input type="hidden" name="action" value="addMedicalRecord">
                <input type="hidden" name="petId" value="<?php echo($_GET["id"]); ?>">
              <div class="row">
              <div class="col-md-12">

              <div class="form-group">
                      <label for="exampleInputEmail1">Pet Name <span class="color-red">*</span></label>
                      <input disabled type="text" value="<?php echo($pet["petName"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>

                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                      <label>Service Availed</label>
                      <select required name="service" class="form-control"  style="width: 100%;">
                        <option value="">Please select service</option>
                        <option value="Checkup">Check Up</option>
                        <option value="Vaccination">Vaccination</option>
                        <option value="Anti Rabies">Anti Rabies</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Type</label>
                      <select required name="recordType" class="form-control"  style="width: 100%;">
                        <option value="">Please select type</option>
                        <option value="Online">Online</option>
                        <option value="Walk-in">Walk-in</option>
                      </select>
                    </div>
                  </div>
                </div>
                

                <div class="form-group">
                  <label for="exampleInputEmail1">Symptoms</label>
                  <textarea name="symptoms" class="summernote" >
                    
                  </textarea>
                </div>
                <hr>
                <div class="form-group">
                  <label>Disease (if any)</label>
                  <select multiple name="disease[]" class="form-control" id="diseaseSelect" style="width: 100%;">
                    <option></option>
                    <?php foreach($diseases as $row): ?>
                      <option value="<?php echo($row["diseaseId"]); ?>"><?php echo($row["diseaseName"]); ?></option>
                    <?php endforeach; ?>
                   
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Prescriptions (if any)</label>
                  <textarea name="prescriptions" class="summernote" >
                    
                  </textarea>
                </div>
                <hr>
                <div class="form-group">
                  <label for="exampleInputEmail1">Doctor's Note (optional)</label>
                  <textarea name="doctorNote" class="summernote" >
                    
                  </textarea>
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
                <?php if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"): ?>
              <a style="float:right;" class="btn btn-warning" href="#" data-toggle="modal" data-target="#modalNewMedical">Add New Medical Record</a>
                <?php endif; ?>
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
                    <th>Type</th>
                    <th>Service</th>
                    <th>Disease</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($medicalRecords as $row): ?>
                    <tr data-widget="expandable-table" aria-expanded="false">
                      <td><?php echo($row["dateCheckup"]); ?></td>
                      <td><?php echo($row["type"]); ?></td>
                      <td><?php echo($row["service"]); ?></td>
                      <?php
                      $rowdecease = "";
                      if(isset($Disease[$row["checkupId"]])):
                        $rowdecease = implode(', ', $Disease[$row["checkupId"]]);
                        // dump($rowdecease);
                      endif;
                      ?>
                      <td><?php echo($rowdecease); ?></td>

                    </tr>
                    <tr class="expandable-body">
                      <td colspan="4">
                        <div class="content">
                        <h5>Symptoms</h5>
                        <?php echo($row["symptoms"]); ?>
                        <br>
                        <h5>Prescriptions</h5>
                        <?php echo($row["prescription"]); ?>
                        <?php
                          if($row["prescription"] != ""):
                            echo('
                                    <br>
                                    <form class="generic_form_trigger" data-rule="pets">
                                      <input type="hidden" name="action" value="printPrescription">
                                      <input type="hidden" name="checkupId" value="'.$row["checkupId"].'">
                                      
                                    <button type="submit" class="btn btn-primary btn-sm"> Print Prescription</button>
                                    </form>
                                    
                                    ');
                          endif;
                        ?>
                        <br>
                        <br>
                        <h5>Doctor's Note</h5>
                        <?php echo($row["doctorsNote"]); ?>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    
                  </tbody>
                 
                  
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
<script src="AdminLTE_new/plugins/summernote/summernote-bs4.min.js"></script>
<script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>


<script>
  
  $('#diseaseSelect').select2({
    placeholder: 'Select a disease' // Replace 'Select a disease' with your desired placeholder text
});
  $('.summernote').summernote()
            $('.sampleDatatable').DataTable({
            });

</script> 
