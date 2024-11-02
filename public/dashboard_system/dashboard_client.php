
<!-- <link rel="stylesheet" href="AdminLTE/bower_components/jvectormap/jquery-jvectormap.css"> -->
<!-- <link rel="stylesheet" href="AdminLTE_new/plugins/jqvmap/jqvmap.min.css"> -->
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
    <style>
  .iframe-container {
      position: relative;
      width: 100%; /* Full width */
      padding-top: 150%; /* Maintain aspect ratio */
  }

  .iframe-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%; /* Make the iframe responsive */
      height: 100%;
  }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
                  <ol class="carousel-indicators">

                  <?php 
                  $announcements = query("select * from announcements where status = 'ACTIVE'");
                  $i=0;
                  foreach($announcements as $row): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo($i); ?>" <?php echo $i == 0 ? 'class="active"' : ''; ?>></li>
                  <?php $i++; endforeach; ?>
                  </ol>
                  <div class="carousel-inner">

                  <?php 
                  $announcements = query("select * from announcements where status = 'ACTIVE'");
                  $i=0;
                  foreach($announcements as $row): ?>
                    <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>" >
                      <img class="d-block w-100" src="<?php echo($row["banner_image"]); ?>" alt="First slide">
                      <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.8);">
                          <h5><?php echo($row["title"]); ?></h5>
                          <p><?php echo($row["description"]); ?></p>
                      </div>
                    </div>
                  
                  <?php $i++; endforeach; ?>


                    
              
                 
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
          </div>
          <div class="col-4">
          <div class="iframe-container">
            <iframe 
                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FPanaboCityVet&tabs=timeline&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true" 
                style="border:none; overflow:hidden;" 
                scrolling="no" 
                frameborder="0" 
                allowfullscreen="true" 
                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
            </iframe>
        </div>
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
<?php require("layouts/footer.php") ?>