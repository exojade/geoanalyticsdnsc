
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Doctor's Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form class="generic_form_trigger" data-url="doctors"> -->



                <div class="card-body">

                
              <div id="form_pds_elig" class="ui tiny form">
                        <button @click="goUpdate" class="btn btn-primary btn_pds_elig_update"><i class="fa fa-edit"></i> Update</button>
                        <div class="btns_pds_elig_update btn-group" style="display:none">
                            <button @click="goSave" class="btn btn-success "><i class="fa fa-save"></i> Save</button>
                                <div class="or"></div>
                            <button @click="goCancel" class="btn btn-danger "><i class="fa fa-trash"></i> Discard</button>
                        </div>
                        <br>
                        <br>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gmail Address <span class="text-red">*</span></label>
                        <input :readonly = "readonly" :required="!readonly" v-model="doctor.username" type="email"  class="form-control" id="exampleInputEmail1" placeholder="Should be a valid Gmail account">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">License Number <span class="text-red">*</span></label>
                        <input required value="" type="number" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsLicenseNumber" class="form-control" id="exampleInputEmail1" placeholder="Doctor's License Number">
                    </div>
                  </div>
                </div>
                     


                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">First Name <span class="text-red">*</span></label>
                        <input required value="" type="text" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsFirstname"  class="form-control" id="exampleInputEmail1" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middle Name</label>
                        <input  type="text" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsMiddlename"  name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name <span class="text-red">*</span></label>
                        <input required type="text" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsLastname"  class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Doctor's Extension</label>
                        <input  type="text" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsExtension" class="form-control" id="exampleInputEmail1" placeholder="Ex. DVM">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col">
                      <div class="form-group">
                        <label>Region <span class="text-danger">*</span></label>
                      <select 
                      v-bind:class="{ editState: !readonly, readOnly: readonly }" 
                      :disabled="readonly" 
                      v-model="doctor.doctorsRegion" 
                      @change="updateProvinces" 
                      class="form-control"
                      >
                      <option value="" disabled>Select a region</option>
                      <option v-for="region in regions" :key="region.reg_code" :value="region.reg_code">{{ region.name }}</option>
                      </select>
                      </div>
                      </div>

                      <div class="col">
                      <div class="form-group">
                      <label>Province <span class="text-danger">*</span></label>
                      <select 
                      v-bind:class="{ editState: !readonly, readOnly: readonly }" 
                      :disabled="readonly" 
                      v-model="doctor.doctorsProvince" 
                      @change="updateCities" 
                      class="form-control"
                      >
                      <option value="" disabled>Select a province</option>
                      <option v-for="province in provinces" :key="province.prov_code" :value="province.prov_code">{{ province.name }}</option>
                      </select>
                      </div>
                      </div>

                      <div class="col">
                      <div class="form-group">
                      <label>City / Municipality <span class="text-danger">*</span></label>
                      <select 
                      v-bind:class="{ editState: !readonly, readOnly: readonly }" 
                      :disabled="readonly || !cities.length" 
                      v-model="doctor.doctorsCitymun" 
                      @change="updateBarangays" 
                      class="form-control"
                      >
                      <option value="" disabled>Select a city/municipality</option>
                      <option v-for="city in cities" :key="city.mun_code" :value="city.mun_code">{{ city.name }}</option>
                      </select>
                      </div>
                      </div>

                      <div class="col">
                      <div class="form-group">
                      <label>Barangay <span class="text-danger">*</span></label>
                      <select 
                      v-bind:class="{ editState: !readonly, readOnly: readonly }" 
                      :disabled="readonly || !barangays.length" 
                      v-model="doctor.doctorsBarangay" 
                      class="form-control"
                      >
                      <option value="" disabled>Select a barangay</option>
                      <option v-for="barangay in barangays" :key="barangay.mun_code" :value="barangay.name">{{ barangay.name }}</option>
                      </select>
                      </div>
                      </div>
                      </div>
                  
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Street / House Number / Purok <span class="text-red">*</span></label>
                              <input  :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsAddress" class="form-control"  placeholder="Street / House Number / Purok">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Birthdate <span class="text-red">*</span></label>
                              <input  max="<?php echo date('Y-m-d'); ?>" :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsBirthday"  type="date" class="form-control"  placeholder="Birthdate">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Sex <span class="text-red">*</span></label>
                              <select 
                                v-bind:class="{ editState: !readonly, readOnly: readonly }" 
                                :disabled="readonly" 
                                :required="!readonly" 
                                v-model="doctor.doctorsSex" 
                                class="form-control" 
                              >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                              <label>Contact Number <span class="text-red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input :readonly = "readonly" :required="!readonly" v-model="doctor.doctorsContactNumber" type="text" class="form-control" data-inputmask='"mask": "(+63) 9999999999"' data-mask>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                      </div>



                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
              <!-- </form> -->
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
<script src="resources/js/vue.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="AdminLTE_new/plugins/toastr/toastr.min.js"></script>
<script>
function getRegCodeByName(regionName, regionArray) {
            const region = regionArray.find(r => r.name === regionName);
            return region ? region.reg_code : null; // Return the reg_code or null if not found
        }

function getProvCodeByName(provinceName, provinceArray, reg_code) {

    const province = provinceArray.find(p => p.name === provinceName && p.reg_code === reg_code);
    // console.log(province.prov_code);
    return province ? province.prov_code : null; // Return the prov_code or null if not found
}


function getCityCodeByName(CityName, cityMunArray, prov_code) {

const citymun = cityMunArray.find(c => c.name === CityName && c.prov_code === prov_code);
// console.log(province.prov_code);
return citymun ? citymun.mun_code : null; // Return the prov_code or null if not found
}



function getRegionNameByCode(reg_code, theRegions) {
    const region = theRegions.find(r => r.reg_code === reg_code);
    return region ? region.name : null;
}

function getProvinceNameByCode(prov_code, theProvince) {
    const province = theProvince.find(r => r.prov_code === prov_code);
    return province ? province.name : null;
}

function getCityNameByCode(mun_code, theCity) {
    const city = theCity.find(r => r.mun_code === mun_code);
    return city ? city.name : null;
}


var app_pds_personal = new Vue({
    el: "#form_pds_elig",
    data: {
        readonly: true,
        doctor: {
          doctorsId: "",
          username: "",
          doctorsFirstname: "",
          doctorsMiddlename: "",
          doctorsLastname: "",
          doctorExtension: "",
          doctorsRegion: "",
          doctorsProvince: "",
          doctorsCitymun: "",
          doctorsBarangay: "",
          doctorsAddress: "",
          doctorsContactNumber: "",
          doctorsSex: "",
          doctorsBirthday: "",
          doctorsLicenseNumber: ""
        },

        regions: [],
        provinces: [],
        cities: [],
        barangays: []
    },
    methods: {
        initLocationData() {
            // Get all regions
            console.log(Philippines);
            this.regions = Philippines.sort(Philippines.regions,"A");
            // this.provinces = Philippines.sort(Philippines.regions,"A");
        },
        updateProvinces() {
            const selectedRegion = this.doctor.doctorsRegion;
            console.log(Philippines);
            this.provinces = Philippines.getProvincesByRegion(selectedRegion) || [];
            console.log(this.provinces);
            this.doctor.doctorsProvince = ""; // Reset province selection
            this.cities = []; // Reset city selection
            this.barangays = []; // Reset barangay selection
        },
        updateCities() {
            const selectedProvince = this.doctor.doctorsProvince;
            this.cities = Philippines.getCityMunByProvince(selectedProvince) || [];
            this.doctor.doctorsCitymun = ""; // Reset city selection
            this.barangays = []; // Reset barangay selection
        },
        updateBarangays() {
            const selectedCity = this.doctor.doctorsCitymun;
            this.barangays = Philippines.getBarangayByMun(selectedCity) || [];
            this.doctor.doctorsBarangay = ""; // Reset barangay selection
        },
        getdoctorData(){
            this.doctor.doctorsId = '<?php echo($_GET["id"]); ?>';
                $.ajax({
                    type: "post",
                    url: "doctors",
                    data: {doctorsId: this.doctor.doctorsId, action: "getData"
                    },
                    dataType: "json",
                    success: (response) => {
                        this.doctor = response[0];
                        console.log(this.doctor);
                    this.doctor.doctorsRegion = getRegCodeByName(response[0].doctorsRegion, Philippines.sort(Philippines.regions,"A")) || "";
                    if(this.doctor.doctorsRegion != null)
                      this.provinces = Philippines.getProvincesByRegion(this.doctor.doctorsRegion);
                    
                    this.doctor.doctorsProvince = getProvCodeByName(response[0].doctorsProvince, Philippines.getProvincesByRegion(this.doctor.doctorsRegion), this.doctor.doctorsRegion) || "";
                    
                    
                    this.cities = Philippines.getCityMunByProvince(this.doctor.doctorsProvince);
                    this.doctor.doctorsCitymun = getCityCodeByName(response[0].doctorsCitymun, Philippines.getCityMunByProvince(this.doctor.doctorsProvince), this.doctor.doctorsProvince) || "";

                    this.barangays = Philippines.getBarangayByMun(this.doctor.doctorsCitymun);



                    this.doctor.doctorsBarangay = response[0].doctorsBarangay || "";
                    },
                    async: false,
                });

        },
        goUpdate(){
            this.readonly = false
            $(".btn_pds_elig_update").hide();
            $(".btns_pds_elig_update").show();
        },
        goSave(){
          var codeRegion = this.doctor.doctorsRegion;
          var codeProvince = this.doctor.doctorsProvince;
          var codeCity = this.doctor.doctorsCitymun;
          var codeBrgy = this.doctor.doctorsBarangay;

          this.doctor.doctorsRegion = getRegionNameByCode(codeRegion, Philippines.sort(Philippines.regions,"A")) || "";
          this.doctor.doctorsProvince = getProvinceNameByCode(codeProvince, Philippines.getProvincesByRegion(codeRegion)) || "";
          this.doctor.doctorsCitymun = getCityNameByCode(codeCity, Philippines.getCityMunByProvince(codeProvince)) || "";
          // console.log(this.doctor);
          // this.doctor.Province = getProvCodeByName(codeProvince, Philippines.getProvincesByRegion(codeRegion), codeRegion) || "";
          // this.doctor.City = getCityCodeByName(codeCity, Philippines.getCityMunByProvince(codeProvince), codeProvince) || "";
          // this.doctor.Brgy = Philippines.getBarangayByMun(this.doctor.City);

            toastr.options = {
                "progressBar": true,          // Enables the progress bar
                "positionClass": "toast-top-center",  // Position of the toast
                "timeOut": "3000",            // Duration in milliseconds (e.g., 5000ms = 5s)
                "extendedTimeOut": "500"      // Extra time after hover
            };
            $.post(
              "doctors",
              { action: "updatedoctorInfo", doctor: this.doctor },
              (data) => {
                console.log(data);
                  toastr.success('Doctor Updated');
                  this.getdoctorData()
                this.readonly = true; // Set fields to readonly after saving
                $(".btn_pds_elig_update").show(); // Show update button
                $(".btns_pds_elig_update").hide(); // Hide save/cancel buttons
              },
              "json"
            );
          
        },
        goCancel(){
            this.getdoctorData()
            this.readonly = true
            $(".btn_pds_elig_update").show();
            $(".btns_pds_elig_update").hide();
        }
    },
    mounted() {
        this.initLocationData();
        this.getdoctorData();
        
        // $('.ui.checkbox').checkbox();
        $('#pds_gender').dropdown({
             onChange: (value, text, $choice)=>{
                this.doctor["gender"] = value;
             }
        });
        $('#pds_gender').dropdown('set selected',this.doctor.gender);
        $('#pds_civil_status').dropdown({
            onChange: (value, text, $choice)=>{
               this.doctor["civil_status"] = value;
            }
        });
        $('#pds_civil_status').dropdown('set selected',this.doctor.civil_status);
        $('#pds_blood_type').dropdown({
            onChange: (value, text, $choice)=>{
            this.doctor["blood_type"] = value;
            }
        });
        $('#pds_blood_type').dropdown('set selected',this.doctor.blood_type);


$('#personal_pds_form').validate({
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
        
    },
 
})
</script>

