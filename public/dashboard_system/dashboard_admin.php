
<!-- <link rel="stylesheet" href="AdminLTE/bower_components/jvectormap/jquery-jvectormap.css"> -->
<!-- <link rel="stylesheet" href="AdminLTE_new/plugins/jqvmap/jqvmap.min.css"> -->
<link rel="stylesheet" href="AdminLTE_new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="AdminLTE_new/plugins/daterangepicker/daterangepicker.css">

<style>
        #map{
            height: 100vh;
            width: 100%;
        }

        .info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
    color: #000 !important;
}
.info h4 {
    margin: 0 0 5px;
    color: #000 !important;
}
.info h4:after {
    margin: 0 0 5px;
    color: #000 !important;
}

.legend {
    line-height: 18px;
    color: #555;
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}

.map-label {
    font-size: 14px;
    font-weight: bold;
    color: #333;  /* Dark color for better contrast */
    background-color: rgba(255, 255, 255, 0.7);  /* Semi-transparent background */
    padding: 2px 5px;  /* Padding around the text */
    border-radius: 3px; /* Rounded corners */
    text-align: center;
    box-shadow: 0px 0px 2px rgba(0,0,0,0.5); /* Slight shadow for readability */
}



    </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
     
        </div>
      </div>
    </section> -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <div class="info-box-content">
               
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                <span class="info-box-text">APPOINTMENTS</span>
              </div>
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>

            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <div class="info-box-content">
                <span class="info-box-number">41,410</span>
                <span class="info-box-text">INQUIRIES</span>

              </div>
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-question"></i></span>

            </div>
          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <div class="info-box-content">
                <span class="info-box-number">760</span>
                <span class="info-box-text">PENDING PATIENTS</span>
              </div>
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-paw"></i></span>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <div class="info-box-content">
                <span class="info-box-number">2,000</span>
                <span class="info-box-text">COMPLETED ACTIVITIES</span>
              </div>
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check"></i></span>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-12">


          <div class="card bg-gradient-gray" id="fullscreenDiv">
              <div class="card-header border-0">
                <!-- <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  MAP
                  
                </h3> -->

                <div class="row">
                  <div class="col-4">
                  <div class="form-group">

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">
      <i class="far fa-calendar-alt"></i>
    </span>
  </div>
  <input autocomplete="off" type="text" placeholder="Enter Date Here..." class="form-control" id="reservation" onchange="alert('awit')">
</div>
<!-- /.input group -->
</div>

                  <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="parvoCheckbox"  onchange="updateMapColors()" >
                        <label for="parvoCheckbox">
                        PARVO
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="fluCheckBox"  onchange="updateMapColors()">
                        <label for="fluCheckBox">
                        FLU
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="dengueCheckBox"  onchange="updateMapColors()">
                        <label for="dengueCheckBox">
                        DENGUE
                        </label>
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-4">
                 
                  </div>
                  <div class="col-4">
                  <button class="btn btn-info" style="float:right;" id="toggleFullscreen">Toggle Fullscreen</button>
                  </div>
                </div>

                
                
                <!-- <br>
                <br>
                <br>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary1" value="parvo" onchange="updateMapColors(event, 'parvo')" >
                        <label for="checkboxPrimary1">
                        PARVO
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary2" value="flu" onchange="updateMapColors(event, 'flu')">
                        <label for="checkboxPrimary2">
                        FLU
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary3" value="dengue" onchange="updateMapColors(event, 'dengue')">
                        <label for="checkboxPrimary3">
                        DENGUE
                        </label>
                      </div>
                    </div>
                  </div>
                </div> -->
<!-- 

                <input type="checkbox" id="parvoCheckbox" value="parvo" onchange="updateMapColors()"> PARVO
                <input type="checkbox" id="fluCheckbox" value="flu" onchange="updateMapColors()"> FLU
                <input type="checkbox" id="dengueCheckbox" value="dengue" onchange="updateMapColors()"> DENGUE -->

                <!-- card tools -->
        
                <!-- /.card-tools -->
              </div>
              <div class="card-body" style="height: 400px; overflow: hidden;">
              <div id="map" style="height: 400px;"></div>
  <!-- <button id="focus-single">Focus on Australia</button>
  <button id="focus-multiple">Focus on Australia and Japan</button>
  <button id="focus-coords">Focus on Cyprus</button>
  <button id="focus-init">Return to the initial state</button> -->
  
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
<script src="AdminLTE_new/plugins/moment/moment.min.js"></script>
<script src="AdminLTE_new/plugins/daterangepicker/daterangepicker.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>




<!-- <link rel="stylesheet" media="all" href="vector_maps/jquery-jvectormap.css"/> -->
  <!-- <script src="assets/jquery-1.8.2.js"></script> -->
  <!-- <script src="vector_maps/jquery-jvectormap.js"></script>
  <script src="vector_maps/lib/jquery-mousewheel.js"></script>

  <script src="vector_maps/src/jvectormap.js"></script>

  <script src="vector_maps/src/abstract-element.js"></script>
  <script src="vector_maps/src/abstract-canvas-element.js"></script>
  <script src="vector_maps/src/abstract-shape-element.js"></script>

  <script src="vector_maps/src/svg-element.js"></script>
  <script src="vector_maps/src/svg-group-element.js"></script>
  <script src="vector_maps/src/svg-canvas-element.js"></script>
  <script src="vector_maps/src/svg-shape-element.js"></script>
  <script src="vector_maps/src/svg-path-element.js"></script>
  <script src="vector_maps/src/svg-circle-element.js"></script>
  <script src="vector_maps/src/svg-image-element.js"></script>
  <script src="vector_maps/src/svg-text-element.js"></script>

  <script src="vector_maps/src/vml-element.js"></script>
  <script src="vector_maps/src/vml-group-element.js"></script>
  <script src="vector_maps/src/vml-canvas-element.js"></script>
  <script src="vector_maps/src/vml-shape-element.js"></script>
  <script src="vector_maps/src/vml-path-element.js"></script>
  <script src="vector_maps/src/vml-circle-element.js"></script>
  <script src="vector_maps/src/vml-image-element.js"></script>

  <script src="vector_maps/src/map-object.js"></script>
  <script src="vector_maps/src/region.js"></script>
  <script src="vector_maps/src/marker.js"></script>

  <script src="vector_maps/src/vector-canvas.js"></script>
  <script src="vector_maps/src/simple-scale.js"></script>
  <script src="vector_maps/src/ordinal-scale.js"></script>
  <script src="vector_maps/src/numeric-scale.js"></script>
  <script src="vector_maps/src/color-scale.js"></script>
  <script src="vector_maps/src/legend.js"></script>
  <script src="vector_maps/src/data-series.js"></script>
  <script src="vector_maps/src/proj.js"></script>
  <script src="vector_maps/src/map.js"></script> -->
  <!-- <script src="public/dashboard_system/panabo_map.js"></script> -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="data/line.js"></script>
<script src="data/point.js"></script>
<script src="data/polygon.js"></script>
<script src="data/nepaldata.js"></script>
<script src="data/panabojson.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>




  </script>


<script>

    /*===================================================
                      OSM  LAYER               
===================================================*/

var jsonData = [];


// console.log(jsonData);
  var map = L.map('map').setView([7.358584, 125.649624], 12);
var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
osm.addTo(map);

/*===================================================
                      MARKER               
===================================================*/

var singleMarker = L.marker([28.25255,83.97669]);
singleMarker.addTo(map);
var popup = singleMarker.bindPopup('This is a popup')
popup.addTo(map);

/*===================================================
                     TILE LAYER               
===================================================*/

var CartoDB_DarkMatter = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
subdomains: 'abcd',
	maxZoom: 19
});
// CartoDB_DarkMatter.addTo(map);

// Google Map Layer

googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
 });
//  googleStreets.addTo(map);

 // Satelite Layer
googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
   maxZoom: 20,
   subdomains:['mt0','mt1','mt2','mt3']
 });
// googleSat.addTo(map);

var Stamen_Watercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
 attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
subdomains: 'abcd',
minZoom: 1,
maxZoom: 16,
ext: 'jpg'
});
// Stamen_Watercolor.addTo(map);


/*===================================================
                      GEOJSON               
===================================================*/

// var linedata = L.geoJSON(lineJSON).addTo(map);
// var pointdata = L.geoJSON(pointJSON).addTo(map);
// var nepalData = L.geoJSON(nepaldataa).addTo(map);
var panabodata = L.geoJSON(panabodataa).addTo(map);
var polygondata = L.geoJSON(polygonJSON,{
    onEachFeature: function(feature,layer){
        layer.bindPopup('<b>This is a </b>' + feature.properties.name)
    },
    style:{
        fillColor: 'red',
        fillOpacity:1,
        color: 'green'
    }
}).addTo(map);



/*===================================================
                      LAYER CONTROL               
===================================================*/

var baseLayers = {
    "Satellite":googleSat,
    "Google Map":googleStreets,
    "Water Color":Stamen_Watercolor,
    "OpenStreetMap": osm,
};

var overlays = {
    "Marker": singleMarker,
    // "PointData":pointdata,
    // "LineData":linedata,
    "PolygonData":polygondata
};

L.control.layers(baseLayers, overlays).addTo(map);


/*===================================================
                      SEARCH BUTTON               
===================================================*/

// L.Control.geocoder().addTo(map);


/*===================================================
                      Choropleth Map               
===================================================*/

// L.geoJSON(statesData).addTo(map);


function getColor(d) {
    return d > 300 ? '#D63230' :
           d > 200  ? '#F39237' :
           d > 100  ? '#2C6E49' :
           d >= 1  ? '#2C6E49' :
                      '#5E6572';
}

function style(feature) {
  // console.log(feature);
    return {
        fillColor: getColor(feature.properties.density),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.5
    };
}

L.geoJson(panabodataa, {style: style}).addTo(map);

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.5
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

var geojson;
// ... our listeners
// geojson = L.geoJson(statesData);

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

// function onEachFeature(feature, layer) {
//     layer.on({
//         mouseover: highlightFeature,
//         mouseout: resetHighlight,
//         click: zoomToFeature
//     });
// }

// function onEachFeature(feature, layer) {
//     // Add permanent tooltip for barangay names
//     layer.bindTooltip(feature.properties.name, {
//         permanent: true,     // The label will always be visible
//         direction: 'center', // Tooltip appears in the center of the polygon
//         className: 'map-label'  // Class for custom styling
//     }).openTooltip(); // Display the label immediately

//     // Optional mouseover, mouseout, and click events
//     layer.on({
//         mouseover: highlightFeature,
//         mouseout: resetHighlight,
//         click: zoomToFeature
//     });
// }

function onEachFeature(feature, layer) {
    // Add mouseover event to show tooltip on hover
    layer.on('mouseover', function(e) {
        layer.bindTooltip(feature.properties.name, {
            direction: 'center',  // Tooltip appears in the center of the polygon
            className: 'map-label'  // Class for custom styling
        }).openTooltip(e.latlng);  // Show the tooltip at the location of the mouse cursor
    });

    // Add mouseout event to hide the tooltip when not hovering
    layer.on('mouseout', function(e) {
        layer.closeTooltip();  // Close the tooltip when the mouse leaves the layer
    });

        layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });

    // Optional click event to zoom into the feature
    layer.on('click', zoomToFeature);
}

geojson = L.geoJson(panabodataa, {
    style: style,
    onEachFeature: onEachFeature
}).addTo(map);

var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>Disease Density</h4>' +  (props ?
        '<b>' + props.name + '</b><br><br><b>PARVO: </b><span style="float: right;"> ' + props.parvo + '</span> <br><b>DENGUE:</b><span style="float: right;"> '+props.dengue+'</span><br><b>FLU:</b><span style="float: right;"> '+props.flu+'</span><br><b>TOTAL:<span style="float: right;">'+props.density+'</span></b></sup>'
        : 'Hover over a barangay');
};

info.addTo(map);

var legend = L.control({position: 'bottomleft'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 100, 200, 500, 1000],
        labels = [];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }

    return div;
};
$('#reservation').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        updateMapColors();
    });

    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
legend.addTo(map);
        function updateMapColors() {

          // parvo = $('#reservation').val();
          // alert(parvo);
          var dateRange = $('#reservation').val();
          var parvo = $('#parvoCheckbox').is(':checked');
          var flu = $('#fluCheckBox').is(':checked');
          var dengue = $('#dengueCheckBox').is(':checked');
          // console.log(parvo);
          $.ajax({
            type: 'post',
            url: 'ajaxMapDisease',
            data: {
                action: "ajaxMapDisease",
                parvo: parvo,
                flu: flu,
                dengue: dengue,
                dateRange: dateRange,
            },
            success: function(data) {
                // Parse the received JSON data from PHP
                var densityData = JSON.parse(data);
                console.log(panabodataa);
                // Update the density property of each feature in panabodataa
                panabodataa.features.forEach(function(feature) {
                    // Get the ID of the feature
                    // console.log(feature.properties.id);
                    var id = feature.properties.id;
                    
                    // Check if the density data for this ID exists
                    if (densityData.hasOwnProperty(id)) {
                        // Update the density property of the feature
                        console.log(densityData[id].parvo);
                        // feature.properties.density = densityData[id];
                        feature.properties.dengue = densityData[id].dengue;
                        feature.properties.parvo = densityData[id].parvo;
                        feature.properties.flu = densityData[id].flu;
                        feature.properties.density = densityData[id].dengue + densityData[id].parvo + densityData[id].flu;
                    }
                });

                // Update map layer with the updated density data
                polygondata.clearLayers(); // Clear existing layer
                polygondata = L.geoJSON(panabodataa, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);

                // Update legend
                legend.addTo(map); // Update legend with new color scale
            }
        });
    }


</script>

<script>
$(document).ready(function(){
    $("#toggleFullscreen").click(function(){
        var elem = $("#fullscreenDiv").get(0); // Get the DOM element
        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch(err => {
                alert(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
            });
            $("#map").css("height", "800px"); // Set height to 800px when entering fullscreen
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
            $("#map").css("height", "400px"); // Set height to 400px when exiting fullscreen
        }
    });
});
</script>
<?php require("layouts/footer.php") ?>