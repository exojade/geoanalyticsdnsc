
<!-- <link rel="stylesheet" href="AdminLTE/bower_components/jvectormap/jquery-jvectormap.css"> -->
<!-- <link rel="stylesheet" href="AdminLTE_new/plugins/jqvmap/jqvmap.min.css"> -->
<link rel="stylesheet" href="AdminLTE_new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="AdminLTE_new/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">

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
          <div class="col-12">

          


          <div class="card bg-gradient-gray" id="fullscreenDiv">
             
              <div class="card-body" style="height: 60vh; overflow: hidden;">

              <div class="row">
                  <div class="col-3">
                    <div class="form-group">

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input autocomplete="off" type="text" placeholder="Enter Date Here..." class="form-control" id="reservation" onchange="alert('awit')">
                        </div>
                        </div>

                    </div>
                  <div class="col-8">
                    <select id="diseaseSelect" multiple="multiple" onchange="updateMapColors()" style="width: 100%;">
                        <?php
                        $diseases = query("select * from disease");
                        foreach ($diseases as $row):
                        ?>
                            <option value="<?php echo $row['diseaseId']; ?>" data-disease="<?php echo htmlspecialchars($row['diseaseName']); ?>">
                                <?php echo htmlspecialchars($row['diseaseName']); ?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    </div>

                    <div class="col-1">
                    <button class="btn btn-info btn-block"  id="toggleFullscreen"><i class="fa fa-expand"></i></button>  
                    </div>
                </div>
              <div id="map" style="height: 50vh;"></div>
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

  <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

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
    if (!props) {
        this._div.innerHTML = '<h4>Disease Density</h4>Hover over a barangay';
        return;
    }

    // Collect the selected diseases
    let selectedDiseases = [];
    let selectedDiseasesId = [];

    $('#diseaseSelect option:selected').each(function () {
        let disease = $(this).data('disease'); // Get the disease name
        let disease_id = $(this).val(); // Get the disease ID
       
        selectedDiseases.push(disease);  
        selectedDiseasesId.push(disease_id);  
    });

    // Build the dynamic content based on selected diseases
    let content = `<h4>Disease Density</h4><b>${props.name}</b><br><br>`;
    let total = 0;

    selectedDiseasesId.forEach((diseaseId, index) => {
        if (props[diseaseId] !== undefined) {
            content += `<b>${selectedDiseases[index].toUpperCase()}:</b> <span style="float: right;">${props[diseaseId]}</span><br>`;
            total += props[diseaseId];  // Accumulate total density
        }
    });

    // Add the total density if there are selected diseases
    if (selectedDiseases.length > 0) {
        content += `<b>TOTAL:</b> <span style="float: right;">${total}</span>`;
    }

    // Update the info div with the new content
    this._div.innerHTML = content;
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
    let dateRange = $('#reservation').val();
    let selectedDiseases = $('#diseaseSelect').val(); // Get selected values from Select2

    console.log('Selected Diseases:', selectedDiseases);

    $.ajax({
        type: 'POST',
        url: 'ajaxMapDisease',
        data: {
            action: "ajaxMapDisease",
            selectedDiseases: selectedDiseases,
            dateRange: dateRange
        },
        success: function(data) {
            let densityData = JSON.parse(data);
            console.log(densityData);

            panabodataa.features.forEach(function(feature) {
                let id = feature.properties.id;
                if (densityData.hasOwnProperty(id)) {
                    feature.properties.density = Object.values(densityData[id]).reduce((a, b) => a + b, 0);
                    Object.assign(feature.properties, densityData[id]);
                }
            });

            polygondata.clearLayers();
            polygondata = L.geoJSON(panabodataa, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);

            legend.addTo(map);
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


$('#mySelect').select2({
        // This option will prevent the selected options from showing in the dropdown
        templateResult: function(data) {
            // Check if the option is selected
            if (data.selected) {
                return null; // Do not show the selected option
            }
            return data.text; // Show the option text
        },
        templateSelection: function(data) {
            return data.text; // Show the selected option text in the input
        },
        placeholder: "Select options",
        allowClear: true
    });

    // Event listener to refresh the dropdown options
    $(document).ready(function() {
    // Initialize Select2
    $('#diseaseSelect').select2({
        placeholder: "Select diseases",
        allowClear: true
    });

    // Handle the change event
    $('#diseaseSelect').on('change', function() {
        updateMapColors(); // Call the function to update the map colors
    });
});
</script>
<?php require("layouts/footer.php") ?>