<script src="AdminLTE_new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="AdminLTE_new/dist/js/demo.js"></script> -->
<script src="AdminLTE_new/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$('.generic_form_trigger').submit(function(e) {
  e.preventDefault();

  e.preventDefault();
  var url = $(this).data('url');


  console.log(url);

  Swal.fire({
  title: 'Do you want to submit the changes?',
  showCancelButton: true,
  confirmButtonText: 'Save',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false});
      $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                success: function (results) {
                var o = jQuery.parseJSON(results);
                console.log(o);
                if(o.result === "success") {
                    Swal.close();
                    Swal.fire({title: "Submit success",
                    text: o.message,
                    type:"success"})
                    .then(function () {
                    window.location.replace(o.link);
                    });
                }
                else {
                    Swal.fire({
                    title: "Error!",
                    text: o.message,
                    type:"error"
                    });
                    console.log(results);
                }
                },
                error: function(results) {
                console.log(results);
                swal("Error!", "Unexpected error occur!", "error");
                }
            });
    } else if (result.isDenied) {
    
    }
  })
    });




    $('.generic_form_pdf').submit(function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    Swal.fire({
        title: 'Please wait...',
        imageUrl: 'AdminLTE_new/dist/img/loader.gif',
        showConfirmButton: false
    });
    $.ajax({
        type: 'post',
        url: url,
        data: $(this).serialize(),
        success: function(results) {
            var o = jQuery.parseJSON(results);
            o = o.info["0"];
            console.log(o);
            if (o.result === "success") {
                Swal.close();
                var fileName = o.path;
                $("#dialog").dialog({
                    modal: true,
                    title: fileName,
                    width: 1200,
                    height: "auto",
                    resizable: false,
                    draggable: false,
                    closeOnEscape: true,
                    dialogClass: 'fixed-dialog',
                    buttons: {
                        Close: function() {
                            $(this).dialog('close');
                        },
                        "Open Link": function() {
                            window.open(o.path);
                        },
                    },
                    open: function() {
                        var object = "<object data=\"" + o.path + "\" type=\"application/pdf\" width=\"1200px\" height=\"500px\">";
                        object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
                        object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                        object += "</object>";
                        object = object.replace(/{FileName}/g, "Files/" + fileName);
                        $("#dialog").html(object);
                    }
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: o.message,
                    type: "error"
                });
                console.log(results);
            }
        },
    });
});



$('.generic_form_pdf_dropping').submit(function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    
    // Prompt user for OPERATOR and ADDRESS using SweetAlert
    Swal.fire({
        title: "Enter Operator and Address",
        html:
          '<input required style="width: 83% !important;" id="operator" class="swal2-input" placeholder="Operator">' +
          '<input required style="width: 83% !important;" id="address" class="swal2-input" placeholder="Address">',
        focusConfirm: false,
        preConfirm: () => {
            return {
                operator: $('#operator').val(),
                address: $('#address').val()
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var operator = result.value.operator;
            var address = result.value.address;
            Swal.fire({
                title: 'Please wait...',
                imageUrl: 'AdminLTE_new/dist/img/loader.gif',
                showConfirmButton: false
            });
            // Add OPERATOR and ADDRESS to form data
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize() + '&operator=' + operator + '&address=' + address,
                success: function(results) {
                    var o = jQuery.parseJSON(results);
                    o = o.info["0"];
                    console.log(o);
                    if (o.result === "success") {
                        Swal.close();
                        var fileName = o.path;
                        $("#dialog").dialog({
                            modal: true,
                            title: fileName,
                            width: 1200,
                            height: "auto",
                            resizable: false,
                            draggable: false,
                            closeOnEscape: true,
                            dialogClass: 'fixed-dialog',
                            buttons: {
                                Close: function() {
                                    $(this).dialog('close');
                                },
                                "Open Link": function() {
                                    window.open(o.path);
                                },
                            },
                            open: function() {
                                var object = "<object data=\"" + o.path + "\" type=\"application/pdf\" width=\"1200px\" height=\"500px\">";
                                object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
                                object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                                object += "</object>";
                                object = object.replace(/{FileName}/g, "Files/" + fileName);
                                $("#dialog").html(object);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: o.message,
                            icon: "error",
                        });
                        console.log(results);
                    }
                },
            });
        }
    });
});











    $('.generic_form_files_trigger').submit(function(e) {
  var form = $(this)[0];
	var formData = new FormData(form);
    e.preventDefault();
    console.log(formData);
  var url = $(this).data('url');
  console.log(url);
  Swal.fire({
  title: 'Do you want to save the changes?',
  showCancelButton: true,
  confirmButtonText: 'Save',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      $.ajax({
                type: 'post',
                url: url,
                data: formData,
                processData: false,
    	contentType: false,
                success: function (results) {
                var o = jQuery.parseJSON(results);
                console.log(o);
                if(o.result === "success") {
                    Swal.close();
                    Swal.fire({title: "Submit success",
                    text: o.message,
                    type:"success"})
                    .then(function () {
                    window.location.replace(o.link);
                    });
                }
                else {
                    Swal.fire({
                    title: "Error!",
                    text: o.message,
                    type:"error"
                    });
                    console.log(results);
                }
                },
                error: function(results) {
                console.log(results);
                swal("Error!", "Unexpected error occur!", "error");
                }
            });
    } else if (result.isDenied) {
    
    }
  })
    });

</script>



<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; <?php echo(date("Y")); ?> Animal Health Disease Monitoring Online Checkup Services
  </footer>
    <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
</body>
</html>