
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/fullcalendar/main.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
<div class="content-wrapper">


<div class="modal fade" id="eventModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Appointment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
       
            </div>
     
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModalLabel">My Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      <form class="generic_form_trigger" data-url="doctorSchedule">
        <input type="hidden" name="action" value="updateDoctorSchedule">
    
        <div class="fetched-data"></div>
      <hr>

        <button type="submit" class="btn btn-primary" id="saveEventBtn">Save Event</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</form>
        <!-- Date will be populated here -->
      </div>
 
    </div>
  </div>
</div>



    <section class="content">
      <div class="container-fluid">
        <div class="row">

        <div class="col-4">
        <div class="card card-primary">
              <div class="card-header">
              <h4 class="m-0">Legends / Information
                <!-- <div class="form-group" style="float:right;">
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Book an Appointment</a>
                </div> -->
                </h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="color-palette-set mb-2">
                  <div class="bg-warning color-palette p-2"><span>FOR APPROVAL APPOINTMENT</span></div>
                  <div class="bg-info color-palette p-2"><span>APPROVED APPOINTMENT</span></div>
                  <div class="bg-danger color-palette p-2"><span>UNAVAILABLE SCHEDULE</span></div>
                </div>

              <table class="table table-bordered">
                <?php $timeslot = query("select * from timeslot where remarks = 'active'"); ?>
                <th class="text-center">Time Schedule</th>
                <?php foreach($timeslot as $row): ?>
                  
                  <tr>
                    <td class="text-center"><?php echo($row["timeSlot"]); ?></td>
                  </tr>
                <?php endforeach; ?>

              </table>
              <hr>

              
              </div>
              <!-- /.card-body -->
            </div>
        </div>

          <div class="col-md-8">
          <div class="card">
              <div class="card-header bg-primary">
                <h4 class="m-0">Doctor's Calendar
                <!-- <div class="form-group" style="float:right;">
                  <a href="" data-toggle="modal" data-target="#modalNewPet" class="btn btn-info">Book an Appointment</a>
                </div> -->
                </h4>
              </div>
              <div class="card-body">
              <div id="calendar"></div>
              <!-- <iframe src="https://calendar.google.com/calendar/embed?src=15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2%40group.calendar.google.com&ctz=Asia%2FManila" style="border: 0" width="1000" height="600" frameborder="0" scrolling="no"></iframe> -->

          
              </div>
            </div>
          </div>
        </div>
        




      </div>
    </section>
  </div>
  <?php require("layouts/footer.php") ?>
<script src="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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

<script src="AdminLTE_new/plugins/moment/moment.min.js"></script>
<script src="AdminLTE_new/plugins/fullcalendar/main.js"></script>
<script src="AdminLTE_new/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------


    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events

      dateClick: function(info) {


          Swal.fire({ title: 'Please wait...',
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
            },imageUrl: 'AdminLTE_new/dist/img/loader.gif', showConfirmButton: false });
            var selectedDate = new Date(info.dateStr).toISOString().split('T')[0];
        $.ajax({
          type : 'post',
          url : 'doctorSchedule', //Here you will fetch records 
          data: {
              schedule_date: selectedDate, action: "getDoctorSchedule"
          },
          success : function(data){
            // $("input[data-bootstrap-switch]").each(function(){
            //   $(this).bootstrapSwitch('state', $(this).prop('checked'));
            // })
            $('#dateModal .fetched-data').html(data);
            $('#dateModal').modal('show');
            Swal.close();


            $("input[data-bootstrap-switch]").bootstrapSwitch('destroy'); // Destroy existing instances
    $("input[data-bootstrap-switch]").bootstrapSwitch();

            

          }
      });
    },
      
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      },
      eventClick: function(calEvent, jsEvent, view) {

        var rowid = calEvent.event.extendedProps.appointmentId;
      // Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      $.ajax({
          type : 'post',
          url : 'calendar', //Here you will fetch records 
          data: {
              appointmentId: rowid, action: "modalCalendar"
          },
          success : function(data){
            $('#eventModal .modal-body').html(data);
            // swal.close();
            $('#eventModal').modal('show');

              // Swal.close();
              // $(".select2").select2();//Show fetched data from database
          }
      });

   



      // // Open the modal
      // $('#eventModal').show();

      // // Populate modal with event data
      // $('#eventTitle').text(calEvent.title);
      // // $('#eventDetails').text('Start: ' + calEvent.start.format('YYYY-MM-DD HH:mm:ss'));

      // // Close the modal when close button is clicked
      // $('.close').click(function() {
      //   $('#eventModal').hide();
      // });
    }
    });

    calendar.render();
    $.ajax({
        type : 'post',
        url : 'doctorSchedule', //Here you will fetch records 
        data: {
             action: "calendarApi"
        },
        success: function(response) {
        // Parse the JSON response and add the events to the calendar
        calendar.addEventSource(response);
    },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
        }
    });

  //   $('#calendar').fullCalendar({
  //   // FullCalendar options
   
  // });

    // $.ajax({
    // url: 'get_events.php', // Path to your PHP script
    // type: 'GET',
    // success: function(response) {
    //     // Parse the JSON response and add the events to the calendar
    //     calendar.addEventSource(response);
    // },
    //     error: function(xhr, status, error) {
    //         // Handle errors
    //         console.error(error);
    //     }
    // });
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
