<!-- <style ></style> -->
<link rel="stylesheet" href="AdminLTE_new/plugins/jquery-ui/jquery-ui.min.css">
<style>
  .fixed-dialog{
  position: fixed;
  top: 50px !important;
  left: 250px !important;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      </section>


      <div id="dialog" style="display: none"></div>


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



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="AdminLTE_new/dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo($mtop["firstname"] . " " . $mtop["lastname"]); ?></h3>

                <p class="text-muted text-center"><?php echo($mtop["MTOP_NO"]); ?></p>
                <hr>
                <strong><i class="fas fa-book mr-1"></i> Mayor's Permit Expiration</strong>
                
                <p class="text-muted">
                  <?php echo($mtop["mp_expiration_date"]); ?>
                </p>
                <hr>
                <strong><i class="fas fa-book mr-1"></i> Franchise Expiration</strong>
                
                <p class="text-muted">
                  <?php echo($mtop["expiration_date"]); ?>
                </p>

              </div>
              <!-- /.card-body -->
            </div>

            <?php if(date("Y-m-d") > $mtop["expiration_date"]): ?>
              <a href="#" class="btn btn-block btn-primary">RENEW FRANCHISE</a>
            <?php endif; ?>

            <?php
            // dump(get_defined_vars());
            if(date("Y-m-d") > $mtop["mp_expiration_date"]): ?>
              <a href="transaction?action=mayors_permit&mtop=<?php echo($mtop["MTOP_NO"]); ?>" class="btn btn-block btn-primary">RENEW MAYORS PERMIT</a>
            <?php endif; ?>
            <a href="#" class="btn btn-block btn-primary">UNIT SUBSTITUTION</a>
            <a href="#" class="btn btn-block btn-primary">TRANSFER OF OWNERSHIP</a>
            <a href="#" class="btn btn-block btn-primary">DROPPING OF MTOP</a>
            <!-- <a href="#" class="btn btn-block btn-primary">AWARDING OF MTOP</a> -->
           
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#new_transaction" data-toggle="tab">New Transaction</a></li> -->
                  <li class="nav-item"><a class="nav-link" href="#fees" data-toggle="tab">Fees Logs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#transaction" data-toggle="tab">Transaction Logs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#printable" data-toggle="tab">Printable Forms</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profile">

                
                  <form id="mtop_profile" class="generic_form_trigger" data-url="mtop_profile"> 
                  <input type="hidden" value="update_mtop" name="action">
                  <input type="hidden" value="<?php echo($_GET["mtop"]) ?>" name="mtop">
                  <button id="update_btn_mtop" class="btn btn-primary" type="button">Update</button>
                  <button id="save_btn_mtop" style="display: none;" class="btn btn-success" type="submit">Save</button>
                  <button id="cancel_btn_mtop" style="display: none;" class="btn btn-danger " type="button">Cancel</button>
                  <br>
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input name="firstname" value="<?php echo($mtop["firstname"]); ?>" readonly type="text" class="form-control"  placeholder="---">
                      </div>
                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input name="lastname" value="<?php echo($mtop["lastname"]); ?>" readonly type="text" class="form-control"  placeholder="---">
                      </div>
                    </div>  
                  </div>

                  <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" readonly class="form-control" rows="2" placeholder="---"><?php echo($mtop["address"]); ?></textarea>
                  </div>


                  <div class="form-group">
                      <label>Gender</label>
                      <select name="Gender" id="gender_select" disabled class="form-control">
                        <option value="<?php echo($mtop["Gender"]); ?>"><?php echo($mtop["Gender"]); ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Make</label>
                        <input name="make" value="<?php echo($mtop["make"]); ?>" readonly type="text" class="form-control"  placeholder="---">
                      </div>
                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Motor Number</label>
                        <input name="motor_no" value="<?php echo($mtop["motor_no"]); ?>" readonly type="text" class="form-control" placeholder="---">
                      </div>
                    </div>  
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Plate Number</label>
                        <input name="plate_no" value="<?php echo($mtop["plate_no"]); ?>" readonly type="text" class="form-control" placeholder="---">
                      </div>
                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Chassis / Serial Number</label>
                        <input name="chassis_no" value="<?php echo($mtop["chassis_no"]); ?>" readonly type="text" class="form-control" placeholder="---">
                      </div>
                    </div>  


                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Route</label>
                        <input name="route" value="<?php echo($mtop["route"]); ?>" readonly type="text" class="form-control" placeholder="---">
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Cert of Reg Number</label>
                        <input name="reg_no" value="<?php echo($mtop["reg_no"]); ?>" readonly type="text" class="form-control" placeholder="---">
                      </div>
                    </div>  
                  </div>
                  


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mayor's Expiration Date</label>
                        <input name="mp_expiration_date" value="<?php echo($mtop["mp_expiration_date"]); ?>" readonly type="date" class="form-control" placeholder="---">
                      </div>
                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Franchise Expiration Date</label>
                        <input name="expiration_date" value="<?php echo($mtop["expiration_date"]); ?>" readonly type="date" class="form-control" placeholder="---">
                      </div>
                    </div>   
                  </div>
                  <div class="form-group">
                        <label>Note</label>
                        <textarea name="care_of" readonly class="form-control" rows="3" placeholder="---"><?php echo($mtop["care_of"]); ?></textarea>
                  </div>

                  </form>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="fees">
                  <?php 
                    $fees = query("select * from fees
                                                where MTOP_NO = ?
                                                order by date_paid DESC", $_GET["mtop"]); 
                    // dump($transaction_logs);
                  ?>

                <div class="table-responsive">
                <table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th></th> -->
                      <th>Date</th>
                      <th>OR Number</th>
                      <th>Amount</th>
                      <th>ETRACS?</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($fees as $f): 
                    //  $or_with_g = $f["or_no"] . "G";
                    //  $or_with_dot = $f["or_no"] . ".";

                    //  $f["or_no"] = ltrim($f["or_no"], "0");
                    //  $f["or_no"] = preg_replace('/[^0-9,.]/', '', $f["or_no"]);
                      $etracs_amount = query_etracs("SELECT amount, objid FROM cashreceipt WHERE receiptno = ?", $f["or_no"]);
                      $amount = 0;
                      $etracs = "NOT FOUND";
                      if(empty($etracs_amount)):
                        $amount = (float)$f["filling_fee"] + (float)$f["franchise_fee"] + (float)$f["mayors_permit_fee"] + (float)$f["dropping_fee"] + (float)$f["substitution_fee"] + (float)$f["transfer_fee"] + (float)$f["penalty"];
                        $or_no = "<a href='#' data-toggle='modal' data-target='#modal-ordetails' data-id='".$f["ID"]."' data-options='mtop' >".$f["or_no"]."</a>";
                      else:
                        $amount = $etracs_amount[0]["amount"];
                        $etracs = "FOUND";
                        $or_no = "<a href='#' data-toggle='modal' data-target='#modal-ordetails' data-id='".$etracs_amount[0]["objid"]."' data-options='etracs' >".$f["or_no"]."</a>";
                      endif;
                      // dump($sql);
                      ?>
                      <tr>
                        <td><?php echo($f["date_paid"]); ?></td>
                        <td><?php echo($or_no); ?></td>
                        <td class="text-right"><?php echo(to_peso($amount)); ?></td>
                        <td><?php echo($etracs); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="transaction">
                  <?php 
                    $transaction_logs = query("select * from transaction_logs
                                                where MTOP_NO = ?
                                                order by ddate DESC", $_GET["mtop"]); 
                    // dump($transaction_logs);
                  ?>

<div class="table-responsive">
<table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>OR</th>
                      <th>Details</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($transaction_logs as $logs): 
                      ?>
                      <tr>
                        <td><?php echo($logs["ddate"]); ?></td>
                        <td><?php
                        $or_with_g = $logs["or_no"] . "G";
                        $or_with_dot = $logs["or_no"] . ".";
                        $etracs_amount = query_etracs("SELECT amount, objid FROM cashreceipt WHERE receiptno = ? or receiptno = ? or receiptno = ?", $logs["or_no"], $or_with_g, $or_with_dot);
                        $amount = 0;
                        $etracs = "NOT FOUND";
                        if(empty($etracs_amount)):
                          // $amount = (float)$f["filling_fee"] + (float)$f["franchise_fee"] + (float)$f["mayors_permit_fee"] + (float)$f["dropping_fee"] + (float)$f["substitution_fee"] + (float)$f["transfer_fee"] + (float)$f["penalty"];
                          $or_no = "<a href='#' data-toggle='modal' data-target='#modal-ordetails' data-id='".$f["ID"]."' data-options='mtop' >".$logs["or_no"]."</a>";
                        else:
                          // $amount = $etracs_amount[0]["amount"];
                          // $etracs = "FOUND";
                          $or_no = "<a href='#' data-toggle='modal' data-target='#modal-ordetails' data-id='".$etracs_amount[0]["objid"]."' data-options='etracs' >".$logs["or_no"]."</a>";
                        endif;
                        
                        
                        echo($or_no); ?></td>
                        <td>
                        <?php 
                        if($logs["or_items"] != ""):
                          $details = unserialize($logs["or_items"]);
                          foreach($details as $d):
                            echo($d["item_title"] . "<br>");
                          endforeach;
                        endif;
                       
                        ?>

                        </td>

                        <td><?php echo($logs["type"]); ?></td>
                        <td><?php echo("Operator: " . $logs["firstname"] . " " . $logs["lastname"] . "<br>" .$logs["action"]); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <style>
                    #printable .col-md-6{
                      margin-top: 10px;
                    }
                  </style>
                  <div class="tab-pane" id="printable">
                    <div class="row">
                      <div class="col-md-6">
                        <form class="generic_form_pdf" url="mtop_profile">
                          <input type="hidden" name="action" value="print_renew">
                          <input type="hidden" name="mtop_no" value="<?php echo($_GET["mtop"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block">PRINT MTOP FRONT</button>
                        </form>
                      </div>  
                      <div class="col-md-6">
                      <form class="generic_form_pdf" url="mtop_profile">
                          <input type="hidden" name="action" value="print_renew_back">
                          <input type="hidden" name="mtop_no" value="<?php echo($_GET["mtop"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block">PRINT MTOP BACK</button>
                        </form>
                      </div> 
                      <div class="col-md-6">
                      <form class="generic_form_pdf_dropping" url="mtop_profile">
                          <input type="hidden" name="action" value="print_dropping">
                          <input type="hidden" name="mtop_no" value="<?php echo($_GET["mtop"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block">PRINT FOR DROPPING</button>
                        </form>
                        <!-- <button class="btn btn-primary btn-block">PRINT FOR DROPPING</button> -->
                      </div>  
                      <div class="col-md-6">
                        <form class="generic_form_pdf" url="mtop_profile">
                          <input type="hidden" name="action" value="print_mayors_permit">
                          <input type="hidden" name="mtop_no" value="<?php echo($_GET["mtop"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block">PRINT FOR MAYOR'S PERMIT</button>
                        </form>
                        <!-- <button class="btn btn-primary btn-block">PRINT FOR MAYOR'S PERMIT</button> -->
                      </div> 
                      <div class="col-md-6">
                        <form class="generic_form_pdf" url="mtop_profile">
                          <input type="hidden" name="action" value="print_substitution">
                          <input type="hidden" name="mtop_no" value="<?php echo($_GET["mtop"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block">PRINT FOR SUBSTITUTION</button>
                        </form>
                      </div>   
                      <div class="col-md-6">
                        <button class="btn btn-primary btn-block">PRINT NOTICE</button>
                      </div>  
                    </div>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
$("#update_btn_mtop").click(function() {
  $("#save_btn_mtop").show(); //Showing submit_text
  $("#cancel_btn_mtop").show(); //Showing submit_text
  $("#update_btn_mtop").hide(); //Showing submit_text
  $("#mtop_profile :input").prop('readonly', false); //Making all inputs to disabled
  $("#mtop_profile #gender_select").prop('disabled', false); //Making all inputs to disabled
});

$("#cancel_btn_mtop").click(function() {
  $("#save_btn_mtop").hide(); //Showing submit_text
  $("#cancel_btn_mtop").hide(); //Showing submit_text
  $("#update_btn_mtop").show(); //Showing submit_text
  $("#mtop_profile :input").prop('readonly', true); //Making all inputs to disabled
  $("#mtop_profile #gender_select").prop('disabled', true); //Making all inputs to disabled
});


$('#modal-ordetails').on('show.bs.modal', function (e) {
		var id = $(e.relatedTarget).data('id');
		var options = $(e.relatedTarget).data('options');
    console.log(options);
		$.ajax({
			type : 'post',
			url : 'mtop_profile', //Here you will fetch records 
      data: {
        id: id,
        options : options,
        action : "or_details",
      },
			// data :  'mtop_id='+ rowid, //Pass $id
			success : function(data){
			$('.or-fetched').html(data);//Show fetched data from database
			}
		});
	 });


  </script>

  <?php require("layouts/footer.php") ?>