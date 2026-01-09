<?php
$countries = TantoniusMap::activeCountries();
?>
<div id="tantoniusWorldMapCountryListButton">
  <img src="/wp-content/plugins/semanetwork-collective-memory/images/globe.png">
  List of countries
</div>

<div class="tantonius_world_map_country_list">
   <?php $counter = 1; ?>
    <?php foreach ($countries as $country) : ?>
        <?php echo (TantoniusMap::renderLink($country)) ?>
        <?php $counter++; ?>
    <?php endforeach ?>
</div>