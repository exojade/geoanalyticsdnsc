  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">


  <style>
    .title-header-panel{
      padding: 10px;
      margin: 12px auto 12px auto;
    }
  </style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Award MTOP</h1>
          </div>
     
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


    <div class="modal fade" id="modal-ordetails">
        <div class="modal-dialog modal-lg">
          <div class="modal-content ">
            <div class="modal-header bg-primary">
              <h4 class="modal-title text-center">Official Receipt Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			          <div class="or-fetched"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="modal-billing">
        <div class="modal-dialog modal-md">
          <div class="modal-content ">
            <div class="modal-header bg-primary">
              <h4 class="modal-title text-center">Billing</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-bordered">
                <thead>
                  <th>Fee</th>
                  <th>Amount</th>
                </thead>
                <tbody>
                  <?php
                  $total_fee = 0;
                  foreach($bill as $row): 
                    $total_fee = $total_fee + $row["amount"];
                    ?>
                    <tr>
                    <td><?php echo($row["title"]); ?></td>
                    <td class="text-right"><?php echo(to_peso($row["amount"])); ?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td><b>Total</b></td>
                    <td  class="text-right"><b><?php echo(to_peso($total_fee)); ?></b></td>
                  </tr>
                </tbody>

              </table>
			          
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            
            <div class="card">
              <div class="card-body">
              <form class="generic_form_trigger" data-url="award">
                <input type="hidden" name="action" value="awardMTOP">

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <select name="mtop_no" class="form-control select2" id="mtop_no" style="width: 45%;">
                        <option selected="selected"></option>
                        <?php foreach($mtop as $row): ?>
                          <option value="<?php echo($row["MTOP_NO"]); ?>"><?php echo($row["MTOP_NO"]); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <a href="#" data-toggle="modal" data-target="#modal-billing" class="btn btn-warning" style="float:right;">View Billing</a>
                  </div>
                </div>
              

                <div class="bg-primary title-header-panel"><span>Operator's Information</span></div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>First Name <span style="color:red;">*</span></label>
                      <input name="firstname" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input name="middlename" type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label>Last Name <span style="color:red;">*</span></label>
                      <input name="lastname" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>

                  <div class="col-1">
                    <div class="form-group">
                      <label>Suffix</label>
                      <input name="suffix" type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                  
                  <div class="form-group">
                  <label>Gender</label>
                  <select required name="gender" class="form-control" style="width: 100%;">
                    <option selected="selected" disabled>Please select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>

                  </div>
                  <div class="col-8">
                    <div class="form-group">
                      <label>Address</label>
                      <input name="address" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                    
                  </div>
                </div>

                <div class="bg-primary title-header-panel"><span>Vehicle's Information</span></div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Make</label>
                      <input name="make" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Motor Number</label>
                      <input name="motor_no" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Plate Number</label>
                      <input name="plate_no" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Certificate of Registration</label>
                      <input name="certification" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Route</label>
                      <input name="route" type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Chassis / Serial Number</label>
                      <input name="chassis" required type="text" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-12">
                      <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                  </div>
                </div>


                <div class="bg-primary title-header-panel"><span>Payment Information</span></div>

                <div class="row">


                  <div class="col-6">
                  <div class="form-group">
                    <label>Expiry Date</label>
                    <select required class="form-control" name="expiration_date" style="width: 100%;">
                      <option selected="selected" disabled>Please select Date here</option>
                      <?php
                      $year = 2027;

                      for ($month = 1; $month <= 12; $month++) {
                          $firstDayOfMonth = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
                          $monthName = date("F", mktime(0, 0, 0, $month, 1, $year));
                          echo '<option value="' . $firstDayOfMonth . '">' . $monthName . ' 1, ' . $year . '</option>';
                      }
                      ?>
                    </select>
                  </div>

                  </div>

                  <div class="col-5">
                    <div class="form-group">
                      <label>OR Number</label>
                      <input name="or_number" id="official_receipt" required type="text" class="form-control"  placeholder="---">
                    </div>
                  </div>
                  <div class="col-1">
                    <div class="form-group">
                      <label style="color:#fff;">*</label>
                      <button id="searchOR" class="btn btn-danger btn-block"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Submit</button>
                </form>


                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>
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

$(function () {
    // $('.select2').select2()
    $('#mtop_no').select2({
      placeholder: 'Select an MTOP number' 
    })
  })



  $(document).on("click", "#searchOR", function(e) {
    e.preventDefault();
	Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});

  var official_receipt = $('#official_receipt').val();
    $.ajax({
      type : 'post',
      url : 'ajax_etracsOR',
      data :  { official_receipt : official_receipt, action: "etracsOR"},
      success : function(results) {
        //console.log(res);
        $('#modal-ordetails').modal('toggle');
        Swal.close();
        $('.or-fetched').html(results);
		
      },
      error: function(results) {
        console.log(results);
        swal("Error!", "Unexpected error occur!", "error");
      }
    });

    $.ajax({
      type : 'post',
      url : 'similar_profile',
      data :  { keyln : keyln, keyfn : keyfn, keymn : keymn , action: action},
      success : function(results) {
        //console.log(res);
        var r = jQuery.parseJSON(results);
        document.getElementById('similar').innerHTML = r.message;

        if(r.rescount >= 1) {
          // results found
        //   var te = '<table class="table table-striped table-bordered"><thead><th>H.Lastname</th><th>H.Firstname</th><th>H.Middle</th><th>H.Suffix</th><th>Action</th></thead><tbody>';
		  var te ='<table class="table table-striped table-bordered"> \
		 			 <thead> \
		 			 	<th>H.Lastname</th> \
		 			 	<th>H.Firstname</th> \
		 			 	<th>S.Lastname</th> \
		 			 	<th>S.Firstname</th> \
		 			 	<th>Action</th> \
		 			 </thead>';
		 
		  $.each(r.results, function(index, obj) {
            te = te + '<tr>';
            te = te + '<td>' + obj.head_lastname + '</td>';
            te = te + '<td>' + obj.head_firstname + '</td>';
            te = te + '<td>' + obj.spouse_lastname + '</td>';
            te = te + '<td>' + obj.spouse_firstname + '</td>';
            te = te + '<td>' + obj.head_lastname + '</td>';
            te = te + '</tr>';
          });
          te = te + '</tbody></table>'
        }
        else {
          var te = "";
        }

        $('#similardiv').html(te);
		swal.close();

      },
      error: function(res) {
        console.log(res);
        swal("Error!", "Unexpected error occur!", "error");
      }
    });
	


  });



</script>


  <?php require("layouts/footer.php") ?>