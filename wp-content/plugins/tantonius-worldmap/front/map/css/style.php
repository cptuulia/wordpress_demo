<style>
  g#tuulia-test * {
    fill: red !important;
  }

  .worldMapWrapper {
    max-width: 100%;
    padding: 0px !important;
  }


  #tantoniusWorldMapCountryListButton {
      display: none;
  }
   @media only screen and (max-width: 768px) {
     
        #tantoniusWorldMapCountryListButton {
            display: block;
            width: 100%;
            background-color: #B10007;
            padding: 5px;
            border-radius: 5px;
            color: white;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        #tantoniusWorldMapCountryListButton img {
            width: 10%;
        }
    }

  .tantonius_world_map_country_list {
    margin-top: 10px;
    max-width: 100%;
    overflow: hidden;
    background-color: #B10007;
    padding: 10px;
    border-radius: 10px;
    width: 100%;
    padding-left: 6%;
  }


  .tantonius_world_map_country_list a {
    color: black;
    display: block;
    float: left;
    text-decoration: none;
    background-color: white;
    margin-right: 0px;
    border: 5px;
    border-radius: 5px;
    margin-bottom: 5px; 
    margin-left: 5px;
    width: 23%;
    height: 20px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
  }

  .tantonius_world_map_country_list a:hover {
    color: white;
    background-color: #757575 ;
  }

  @media (max-width: 768px) {
    #tantoniusWorldMapCountryListButton {
      display: block;
    }

    .tantonius_world_map_country_list {
      padding: 10px;
      display: none;
    }

    .tantonius_world_map_country_list a {
      width: 100%;
      font-size: 20px;
      height: 30px;
      background-color: white;
    }

  }

  .mapSvgBackground {
    background-color: lightgray;
    margin: 0xp !important;
  }

  .countryArea {
    fill: #B10007;
    stroke: #FFFFFF;
    stroke-width: 0.05;
    stroke-miterlimit: 10;
  }





  /* Selected countries */
  <?php foreach (TantoniusMap::activeCountries() as $country): ?>
    g#<?php echo $country['wm_country'] ?> *,
  <?php endforeach ?>dummy {
    fill: #757575 !important;
  }


  /* Hover */
  <?php foreach (TantoniusMap::activeCountries() as $country): ?>
    g#<?php echo $country['wm_country'] ?>:hover *,
  <?php endforeach ?>dummy {
    fill: #dbcdab !important;
    cursor: pointer;
  }



  .map-control-buttons {
    position: relative;
    padding: 50px 0;
  }

  .map-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: rgba(0, 0, 0, 0.45);
  }

  .map-control-buttons svg {
    width: 100%;
    height: 100vh;
    max-height: 640px;
  }

  .info-box {
    position: absolute;
    width: 200px;
    z-index: 2;
    background: #fff;
    box-shadow: 0 3px 5px 5px rgba(120, 94, 35, 0.13);
    border-radius: 4px;
    display: flex;
    flex-wrap: wrap;
    border: 3px solid #31364f;
    align-items: flex-start;
  }

  .info-box.center-it {
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 30%;
  }

  .info-box span:last-child {
    position: absolute;
    top: 0;
    right: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .info-box .content {
    display: flex;
    align-items: flex-start;
    flex: 1 0 100%;
    padding: 20px;
  }

  .info-box strong {
    position: relative;
    font-size: 20px;
    display: flex;
    padding: 10px 40px 10px 20px;
    background: white;
    color: #31364f;
    text-align: center;
    flex: 1 0 100%;
  }

  .info-box img {
    width: 100%;
    object-fit: contain;
    background: white;
    margin-bottom: 10px;
    border-radius: 5px;
  }

  .info-box p {
    width: 65%;
    font-size: 14px;
  }

  .legenda {
    position: absolute;
    bottom: 0;
    display: flex;
    justify-content: center;
    left: 0;
    right: 0;
    margin: 0 auto;
  }

  .l-item {
    display: inline-flex;
    align-items: center;
    font-size: 0.9rem;
    padding-right: 30px;
  }

  @media (max-width: 768px) {
    .map-control-buttons {
      padding-bottom: 100px;
    }

    .legenda {
      position: absolute;
      flex-direction: column;
      bottom: 0;
    }

    .info-box {
      position: absolute;
      top: 60px !important;
      left: 0 !important;
      width: 100%;
    }

    .map-control-buttons svg {
      height: 400px !important;
    }
  }
</style>