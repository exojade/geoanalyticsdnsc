
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">



      <div class="alert alert-warning alert-dismissible">
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  Before you can proceed and use the system, it is essential to complete the form provided. Please ensure all required fields are filled out accurately.
                </div>
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
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">First Name <span class="text-red">*</span></label>
                        <input required value="<?php echo($client["firstname"]); ?>" type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middle Name </label>
                        <input  type="text" value="<?php echo($client["middlename"]); ?>" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name <span class="text-red">*</span></label>
                        <input required type="text" value="<?php echo($client["lastname"]); ?>" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Name Extension</label>
                        <input  type="text" value="<?php echo($client["nameExtension"]); ?>" name="nameExtension" class="form-control" id="exampleInputEmail1" placeholder="Ex. Sr. Jr. II III">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Region <span class="text-red">*</span></label>
                              <select required class="form-control select2" id="region_select">
                                <?php if($client["region"] != ""): ?>
                                  <option selected value="<?php echo($client["region"]); ?>"><?php echo($client["region"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Province <span class="text-red">*</span></label>
                              <select required class="form-control select2" id="province_select">
                                <?php if($scholar["address_barangay"] != ""): ?>
                                  <option selected value="<?php echo($scholar["address_province"]); ?>"><?php echo($scholar["address_province"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">City | Municipality <span class="text-red">*</span></label>
                              <select required class="form-control select2" id="city_mun_select">
                                <?php if($scholar["address_city"] != ""): ?>
                                  <option selected value="<?php echo($scholar["address_city"]); ?>"><?php echo($scholar["address_city"]); ?></option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Barangay <span class="text-red">*</span></label>
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
                              <label>Street / House Number / Purok <span class="text-red">*</span></label>
                              <input value="<?php echo($client["address"]); ?>" name="address" required type="text" class="form-control"  placeholder="Street / House Number / Purok">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Birthdate <span class="text-red">*</span></label>
                              <input  max="<?php echo date('Y-m-d'); ?>" value="<?php echo($client["birthDate"]); ?>" name="birthDate" required type="date" class="form-control"  placeholder="Birthdate">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Sex <span class="text-red">*</span></label>
                              <select required name="gender" class="form-control select2" >
                                <?php if($client["gender"] == ""): ?>
                                  <option disabled selected value="">Please select Sex</option>
                                <?php else: ?>
                                  <option selected value="<?php echo($client["gender"]); ?>"><?php echo($client["gender"]); ?></option>
                                  <option disabled value="">Please select Sex</option>
                                <?php endif; ?>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                              <label>Contact Number:</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="contactNumber" required type="text" class="form-control" data-inputmask='"mask": "(+63) 9999999999"' data-mask>
                              </div>
                              <!-- /.input group -->
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

<script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

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


<script>
  $('[data-mask]').inputmask()
    $('#region_select').select2({
      placeholder: 'Please select Region'
    });
    $('#province_select').select2({
      placeholder: 'Please select Province'
    });

    $('#city_mun_select').select2({
      placeholder: 'Please select City / Municipality'
    });

    $('#barangay_select').select2({
      placeholder: 'Please select Barangay'
    });
    


    
    var selectedRegion = '';
    var selectedCity = '';
  
    var all_region = Philippines.sort(Philippines.regions,"A");
      html = "<option value='' disabled selected></option>";
    for(var key in all_region) {
      // console.log(all_province[key].name);
        html += "<option value=" + all_region[key].reg_code  + ">" +all_region[key].name + "</option>"
    }
    document.getElementById("region_select").innerHTML = html;


    function getRegion(){
      $('#true_region').val($( "#region_select option:selected" ).text());
    province = Philippines.getProvincesByRegion($('#region_select').val(), 'A');
    selectedRegion = $('#region_select').val();
    // console.log(selectedRegion);
 
    html = "<option value='' disabled selected></option>";
    for(var key in province) {
      // console.log(city_mun[key].name);
        html += "<option value=" + province[key].prov_code  + ">" +province[key].name + "</option>"
    }
    document.getElementById("province_select").innerHTML = html;
    }





  $('#region_select').change(function(){
    getRegion();
});

function getProvince(){
  $('#true_province').val($( "#province_select option:selected" ).text());
    city_mun = Philippines.getCityMunByProvince($('#province_select').val(), 'A');
    
    html = "<option value='' disabled selected></option>";
    for(var key in city_mun) {
      // console.log(city_mun[key].name);
        html += "<option value=" + city_mun[key].mun_code  + ">" +city_mun[key].name + "</option>"
    }
    document.getElementById("city_mun_select").innerHTML = html;
    }




$('#province_select').change(function(){
  getProvince();
});


function getcityMun(){
  $('#true_city_mun').val($( "#city_mun_select option:selected" ).text());
  console.log($('#city_mun_select').val());
    barangay = Philippines.getBarangayByMun($('#city_mun_select').val(), 'A');
    html = "<option value='' disabled selected></option>";
    for(var key in barangay) {
      // console.log(city_mun[key].name);
        html += "<option value=" + barangay[key].mun_code  + ">" +barangay[key].name + "</option>"
    }
    document.getElementById("barangay_select").innerHTML = html;
    }


$('#city_mun_select').change(function(){

  getcityMun();

    // console.log(Philippines.getZipCode(selectedRegion, selectedProvince));
});

$('#barangay_select').change(function(){
    $('#true_barangay').val($( "#barangay_select option:selected" ).text());

});


            $('.sampleDatatable').DataTable({
            });


            $(document).ready(function() {
    $('[data-mask]').inputmask();
    $('#region_select').select2({
        placeholder: 'Please select Region'
    });
    $('#province_select').select2({
        placeholder: 'Please select Province'
    });
    $('#city_mun_select').select2({
        placeholder: 'Please select City / Municipality'
    });
    $('#barangay_select').select2({
        placeholder: 'Please select Barangay'
    });

    var selectedRegion = 'Region XI';  // Predefined region
    var selectedProvince = 'Davao del Norte';  // Predefined province
    var selectedCity = 'Panabo City';  // Predefined city

    // Predefine region
   
    $('#region_select').append('<option value="11" selected>Region XI (DAVAO REGION)</option>');
    getRegion();
    // Predefine province
    $('#province_select').append('<option value="1123" selected>DAVAO DEL NORTE</option>');
    getProvince();
    // // Predefine city
    $('#city_mun_select').append('<option value="112315" selected>CITY OF PANABO</option>');
    getcityMun();
    // Populate barangays for Panabo City
    // var barangays = Philippines.getBarangayByMun('Panabo City', 'A');
    // var html = "<option value='' disabled selected></option>";
    // for(var key in barangays) {
    //     html += "<option value=" + barangays[key].mun_code  + ">" + barangays[key].name + "</option>"
    // }
    // document.getElementById("barangay_select").innerHTML = html;

    // Disable the region, province, and city selects
    $('#region_select').prop('disabled', true);
    $('#province_select').prop('disabled', true);
    $('#city_mun_select').prop('disabled', true);
});

</script> 

