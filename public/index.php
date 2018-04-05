<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<!-- Page Content -->
<div class="container">

  <div class="row">
    <!-- Categories here -->
    <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
    <!-- end Categories here -->


    <div class="col-md-9">
      <div class="row carousel-holder">
        <div class="col-md-12">
          <!-- Carousel here -->
          <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>
          <!-- end Carousel here -->
        </div>
      </div>
      <div class="row">
        <?php get_products(); ?>


      </div> <!-- end row here -->

    </div>

  </div>

</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
