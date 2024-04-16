<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
     
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-5">


          <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  MAP
                </h3>
                <!-- card tools -->
        
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 600px; width: 100%;"></div>
              </div>
            </div>



            <!-- Default box -->
           
          </div>
        </div>
      </div>
    </section>
  </div>



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


<!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- Morris.js charts -->
<script src="AdminLTE/bower_components/raphael/raphael.min.js"></script>
<!-- <script src="bower_components/morris.js/morris.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->

<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> -->
<script src="AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="public/dashboard_system/panabo_map.js"></script>
<!-- jQuery Knob Chart -->
<!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="bower_components/moment/min/moment.min.js"></script> -->
<!-- <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<!-- Slimscroll -->
<!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="bower_components/fastclick/lib/fastclick.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->

<script>
var visitorsData = {
    path1: 200, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000 // Russia
};

$('#world-map').vectorMap({
    map: 'usa_en',
    backgroundColor: 'transparent',
    regionStyle: {
        initial: {
            fill: '#fff',
            'fill-opacity': 20,
            stroke: '#000', // Set stroke color to black
            'stroke-width': 1, // Adjusted stroke width
            'stroke-opacity': 1 // Adjusted stroke opacity
        }
    },
    series: {
        regions: [{
            attribute: 'fill',
            values: {
                "1": '#ccc', // Color for path with ID "1"
                "34": '#ccc', // Color for path with ID "2"
                "7": '#ccc'  // Color for path with ID "2"
            },
            // scale: ['#ffffff', '#0154ad'],
            // normalizeFunction: 'polynomial'
        }]
    },
    onRegionLabelShow: function (e, el, code) {
    console.log("Region label show event triggered for code: ", code);

    // Check if el is a jQuery object
    if (!(el instanceof jQuery)) {
        console.error("el is not a jQuery object.");
        return;
    }

    // Set custom HTML content for the label
    el.html("awit");

    // Log the HTML content of the label
    console.log("Label HTML content: ", el.html());
}
});

</script>


<?php require("layouts/footer.php") ?>