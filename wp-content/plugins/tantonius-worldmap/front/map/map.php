<?php

require_once __DIR__ . '/../../lib/TantoniusMap.php';


/*
<!-- https://www.mukwegefoundation.org/wp-includes/css/dist/block-library/style.min.css?ver=6.8.3 -->
<link rel='stylesheet' id='wp-block-library-css' href='https://www.mukwegefoundation.org/wp-includes/css/dist/block-library/style.min.css?ver=6.8.3' type='text/css' media='all' />

<!--  https://www.mukwegefoundation.org/wp-content/plugins/give-recurring/assets/css/give-recurring.min.css?ver=2.16.0 -->
<link rel='stylesheet' id='give_recurring_css-css' href='https://www.mukwegefoundation.org/wp-content/plugins/give-recurring/assets/css/give-recurring.min.css?ver=2.16.0' type='text/css' media='all' />
<!--   -->
<link rel='stylesheet' id='theme-style-css' href='https://www.mukwegefoundation.org/wp-content/themes/suprevo-mukwege/assets/css/main.min.css?ver=1744117434' type='text/css' media='all' />
<!--  https://www.mukwegefoundation.org/wp-content/themes/suprevo-mukwege/assets/css/main.min.css?ver=1744117434 -->
<script type="text/javascript" src="https://www.mukwegefoundation.org/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
<!-- https://www.mukwegefoundation.org/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1  -->
<script type="text/javascript" src="https://www.mukwegefoundation.org/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
<!-- https://www.mukwegefoundation.org/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3  -->
<script type="text/javascript" src="https://www.mukwegefoundation.org/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3" id="jquery-ui-core-js"></script>
*/
?>


<?php include_once __DIR__ . '/css/style.php' ?>
<?php include_once __DIR__ . '/js/js.php' ?>

<div class="worldMapWrapper">
  <figure class="map-control-buttons destinations-map">
    <div class="map-overlay"></div>


    <div class="info-box" style="display: none;">
      <strong class="country">
        <span class="fill"></span><span class="close"><i class="fas fa-times"></i></span>
      </strong>
      <div class="content">
        <a href="#" class = "tantoniusWorldMapLink">  
          <img>
           <p style ="text-transform: none !important; color:red;">Read More</p>
        </a>
       
      </div>
    </div>

    <svg
        version="1.1" 
        id="Layer_1" 
        xmlns="http://www.w3.org/2000/svg" 
        xmlns:xlink="http://www.w3.org/1999/xlink" 
        x="0px" 
        y="0px"
        viewBox="0 0 70 450" 
        style="enable-background:new 0 0 670 450;" 
        xml:space="preserve" 
        class="mapSvgBackground"
        >
      <?php include_once __DIR__ . '/partials/mapCoordinates.php' ?>
    </svg>
      <?php include_once __DIR__ . '/partials/countryList.php' ?>
</div>

