
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

<?php $pet = query("select *, CONCAT(
  FLOOR(DATEDIFF(CURRENT_DATE(), pet.petDob) / 365), ' years, ',
  FLOOR((DATEDIFF(CURRENT_DATE(), pet.petDob) % 365) / 30), ' months, ',
  DATEDIFF(CURRENT_DATE(), pet.petDob) % 30, ' days'
) AS petAge from pet where petId = ?", $_GET["id"]); ?>

<?php $pet = $pet[0]; ?>
<?php $client = query("select * from client where clientId = ?", $pet["clientId"]); ?>
<?php $client = $client[0]; ?>

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
                  <label>Diagnosis</label>
                  <input type="text" class="form-control" name="diagnosis" placeholder="Enter here diagnosis">
                </div>

                <div class="form-group">
                  <label>Treatment</label>
                  <input type="text" class="form-control" name="treatment" placeholder="Enter here treatment">
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




        <?php foreach($medicalRecords as $row): ?>

          <div class="modal fade" id="medRecordModal_<?php echo($row["checkupId"]); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Medical Record: <?php echo($row["checkupId"]); ?></h4>
              </div>
              <div class="modal-body">
              <table class="table" id="sectionTable">
                    <tr>
                      <th>Pet Name:</th>
                      <td><?php echo($pet["petName"]); ?></td>
                      <th>Specie Type:</th>
                      <td><?php echo($pet["petType"]); ?></td>
                    </tr>
                    <tr>
                      <th>Type of Consultation:</th>
                      <td><?php echo($row["type"]); ?></td>
                      <th>Date of Consultation:</th>
                      <td><?php echo($row["dateCheckup"]); ?></td>
                    </tr>
                    <tr>
                      <th>Diagnosis:</th>
                      <td><?php echo($row["diagnosis"]); ?></td>
                      <th>Treatment:</th>
                      <td><?php echo($row["treatment"]); ?></td>
                    </tr>
                  </table>

                  <hr>
                  <h5><b>Symptoms</b></h5>
                  <?php echo($row["symptoms"]); ?>

                  <hr>
                  <h3>Rx [Prescription]</h3>
                  <?php echo($row["prescription"]); ?>
                  <br>
                  <form class="generic_form_trigger" data-url="pets">
                      <input type="hidden" name="action" value="printPrescription">
                      <input type="hidden" name="checkupId" value="<?php echo($row["checkupId"]); ?>">
                    <button type="submit" class="btn btn-primary btn-sm"> Print Prescription</button>
                  </form>

                  <hr>
                  <h5><b>Doctor's Notes</b></h5>
                  <?php echo($row["doctorsNote"]); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>

        <?php endforeach; ?>
        






    <section class="content">
      <div class="container-fluid">
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
                      <th>Pet Name:</th>
                      <td><?php echo($pet["petName"]); ?></td>
                      <th>Specie Type:</th>
                      <td><?php echo($pet["petType"]); ?></td>
                    </tr>
                    <tr>
                      <th>Breed:</th>
                      <td><?php echo($pet["petBreed"]); ?></td>
                      <th>Gender:</th>
                      <td><?php echo($pet["petGender"]); ?></td>
                    </tr>
                    <tr>
                      <th>Condition:</th>
                      <td><?php echo($pet["petCondition"]); ?></td>
                      <th>Age:</th>
                      <td><?php echo($pet["petAge"]); ?></td>
                    </tr>
                    <tr>
                      <th>Description:</th>
                      <td><?php echo($pet["petDescription"]); ?></td>
                      <th>Owner's Name:</th>
                      <td><?php echo($client["lastname"] . ", " . $client["firstname"]); ?></td>
                      
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
      
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Medical History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#vaccination" data-toggle="tab">Vaccination</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                  <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                  <?php if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"): ?>
              <a style="float:right;" class="btn btn-warning" href="#" data-toggle="modal" data-target="#modalNewMedical">Add New Medical Record</a>
              <br>
              <br>
                <?php endif; ?>

                  <table class="table table-bordered table-striped table-hover sampleDatatable">
                  <thead>
                  <tr>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Service</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Disease</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($medicalRecords as $row): ?>
                    <tr data-widget="expandable-table" aria-expanded="false">
                      <td><a href="#" data-toggle="modal" data-target="#medRecordModal_<?php echo($row["checkupId"]); ?>" class="btn btn-primary btn-block">Open Record</a></td>
                      <td><?php echo($row["dateCheckup"]); ?></td>
                      <td><?php echo($row["type"]); ?></td>
                      <td><?php echo($row["service"]); ?></td>
                      <td><?php echo($row["diagnosis"]); ?></td>
                      <td><?php echo($row["treatment"]); ?></td>
                      <?php
                      $rowdecease = "";
                      if(isset($Disease[$row["checkupId"]])):
                        $rowdecease = implode(', ', $Disease[$row["checkupId"]]);
                        // dump($rowdecease);
                      endif;
                      ?>
                      <td><?php echo($rowdecease); ?></td>
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
    placeholder: 'Select a disease', // Replace 'Select a disease' with your desired placeholder text
});
  $('.summernote').summernote()
            $('.sampleDatatable').DataTable({
              ordering: false,
            });

</script> 
