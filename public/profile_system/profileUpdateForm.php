
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="generic_form_trigger" data-url="profileUpdate">
                <input type="hidden" name="action" value="profileUpdate">
                <input type="hidden" name="userid" value="<?php echo($_SESSION["dnsc_geoanalytics"]["userid"]); ?>">


                <input type="hidden" name="region" id="true_region" value="<?php echo($client["region"]); ?>">
                  <input type="hidden" name="province" id="true_province" value="<?php echo($client["province"]); ?>">
                  <input type="hidden" name="cityMun" id="true_city_mun" value="<?php echo($client["cityMun"]); ?>">
                  <input type="hidden" name="barangay" id="true_barangay" value="<?php echo($client["barangay"]); ?>">


                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input value="<?php echo($client["firstname"]); ?>" type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middle Name</label>
                        <input type="text" value="<?php echo($client["middlename"]); ?>" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" value="<?php echo($client["lastname"]); ?>" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Region <span class="color_red">*</span></label>
                              <select required class="form-control select2" id="region_select">
                                <?php if($client["region"] != ""): ?>
                                  <option selected value="<?php echo($client["region"]); ?>"><?php echo($client["region"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Province <span class="color_red">*</span></label>
                              <select required class="form-control select2" id="province_select">
                                <?php if($scholar["address_barangay"] != ""): ?>
                                  <option selected value="<?php echo($scholar["address_province"]); ?>"><?php echo($scholar["address_province"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">City | Municipality <span class="color_red">*</span></label>
                              <select required class="form-control select2" id="city_mun_select">
                                <?php if($scholar["address_city"] != ""): ?>
                                  <option selected value="<?php echo($scholar["address_city"]); ?>"><?php echo($scholar["address_city"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Barangay <span class="color_red">*</span></label>
                              <select required class="form-control select2" id="barangay_select">
                                <?php if($scholar["address_barangay"] != ""): ?>
                                  <option selected value="<?php echo($scholar["address_barangay"]); ?>"><?php echo($scholar["address_barangay"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                      </div>
                  
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Street / House Number / Purok</label>
                              <input value="<?php echo($scholar["address_home"]); ?>" name="address_home" required type="text" class="form-control"  placeholder="Street / House Number / Purok">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Birthdate</label>
                              <input max="<?php echo date('Y-m-d'); ?>" value="<?php echo($scholar["birthdate"]); ?>" name="birthdate" required type="date" class="form-control"  placeholder="Birthdate">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Sex</label>
                              <select name="gender" class="form-control select2" >
                                <?php if($scholar["sex"] == ""): ?>
                                  <option disabled selected value="">Please select Sex</option>
                                <?php else: ?>
                                  <option selected value="<?php echo($scholar["sex"]); ?>"><?php echo($scholar["sex"]); ?></option>
                                  <option disabled value="">Please select Sex</option>
                                <?php endif; ?>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Contact Number</label>
                              <select name="gender" class="form-control select2" >
                                <?php if($scholar["sex"] == ""): ?>
                                  <option disabled selected value="">Please select Sex</option>
                                <?php else: ?>
                                  <option selected value="<?php echo($scholar["sex"]); ?>"><?php echo($scholar["sex"]); ?></option>
                                  <option disabled value="">Please select Sex</option>
                                <?php endif; ?>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                      </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
