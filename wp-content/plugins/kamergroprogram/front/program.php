<?php

/**
 * @propperty string $year
 */

use Kamergro\Controllers\CategoryController;

if (!class_exists('KamerGroProgramFront')) {
  class KamerGroProgramFront
  {

    public static function truncateString(string $string, int $max_chars): string
    {
      $string = trim($string);
      if (strlen($string) > $max_chars) {
        $string = substr($string, 0, $max_chars);
        $pos = strrpos($string, " ");
        if ($pos === false) {
          return $string;
        }
        return substr($string, 0, $pos) . ' ...';
      } else {
        return $string;
      }
    }
  }
}


$params = [
  'localCall' => 1,
  'id' => $categoryId
];
$categoryReponse =  (new CategoryController($params))->show();

$category = $categoryReponse['data'][0];
$dates = $category['items'];
?>
<style>
  .KamerGroProgramFront {
    width: 100%;
    margin: 0px;
    padding: 0px;
    background-color: #E3D499;
    color: black;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
  }



  .KamerGroProgramFront h1 {
    font-size: 2em;
    background-color: #1f2030;
    margin: auto;
    text-align: center;
    width: 100%;
    margin-bottom: 20px;
    color: white;
  }

  .KamerGroProgramFront h2 {
    margin-top: 20px;
    margin-bottom: 10px;
    font-size: 1.2em;
    background-color: #1f2030;
    padding: 4px;
    color: white;
  }

  .KamerGroProgramFront h3 {
    font-size: 1.0em;
    margin-bottom: 10px;
    margin-top: 10px;
  }



  .KamerGroProgramFront .clearBoth {
    clear: both;
    height: 1px !important;
    overflow-y: hidden !important;
    width: 20%;
  }

  .KamerGroProgramFront .event {
    height: 31  0px;
  }


  @media screen and (max-width: 1124px) {
    .KamerGroProgramFront .event {
      height: 530px !important;
    }
  }

  @media screen and (max-width: 999px) {
    .KamerGroProgramFront .event {
      height: auto !important;
    }
  }



  .onevenEvent {
    background-color: #53543F;
    margin-top: 10px;
    margin-bottom: 10px;
  }



  .KamerGroProgramFront .dates {
    width: 100%;
    margin: 0px;
    padding: 0px;
  }

  .KamerGroProgramFront .eventPhoto {
    width: 40%;
    height: 250px;
    float: left;
    margin: 0px;
    padding: 0px;
    padding-top: 25px;
    padding-left: 8px;
    overflow: hidden;
  }

  .KamerGroProgramFront .eventPhoto img {
    width: 100% !important;
    margin: 0px;
  }

  @media screen and (max-width: 1124px) {
    .KamerGroProgramFront .eventPhoto {
      width: 100%;
      padding-top: 5px;
      text-align: center;
      height: 300px !important;
    }

    .KamerGroProgramFront .eventPhoto img {
      width: 300px !important;
      margin: auto;
    }
  }

  @media screen and (max-width: 999px) {
    .KamerGroProgramFront .eventPhoto {
      width: 100%;
      padding-top: 7px;
      text-align: center;
      height: 300px !important;
    }

    .KamerGroProgramFront .eventPhoto img {
      width: 300px !important;
    }
  }


  @media screen and (max-width: 501px) {
    .KamerGroProgramFront .eventPhoto {
      width: 100%;
      padding-top: 7px;
      text-align: center;
      height: 200px !important;
    }

    .KamerGroProgramFront .eventPhoto img {
      width: 200px !important;
    }
  }


  .KamerGroProgramFront .eventText {
    width: 59%;
    float: left;
    margin: 0px;
    padding: 0px;
    font-size: 20px;
    font-weight: 300px;
    padding: 10px;
    overflow: hidden;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
  }


  @media screen and (max-width: 1124px) {
    .KamerGroProgramFront .eventText {
      width: 100%;
      height: auto;
    }
  }

  @media screen and (max-width: 999px) {
    .KamerGroProgramFront .eventText {
      width: 100%;
      margin: 0px;
      padding: 0px;
      padding-top: 20px !important;
      padding: 10px;
      height: auto;
    }
  }


  .KamerGroProgramFront .eventPhoto img {
    width: 25%;
    margin: auto;
  }


  .KamerGroProgramFront .event .buttons_wrapper {
    height: 310px;
    width: 99%;
    position: relative;
  }


  .KamerGroProgramFront .event .buttons_wrapper .buttons {
    position: absolute;
    bottom: 0px;
    right: 10px;
  }


  @media screen and (max-width: 1124px) {
    .KamerGroProgramFront .event .buttons_wrapper {
      height: auto;
      width: 99%;
      position: static;
    }

    .KamerGroProgramFront .event .buttons_wrapper .buttons {
      position: static;
      margin: 0px;
      margin-bottom: 20px !important;
      bottom: auto !important;
    }
  }


  .KamerGroProgramFront .event a {
    height: 35px;
    display: block;
    background-color: #53543F;
    text-decoration: none;
    width: fit-content;
    margin: 0px;
    padding: 10px;
    padding-top: 1px;
    margin-left: 5px;
    border-radius: 15px;
    color: white;
    float: right;
    font-size:15px;
    font-weight: 300px;
    height: 25px;
    color: white !important;
  }


  .KamerGroProgramFront .onevenEvent a {
    background-color: #1f2030;
    ;
  }
</style>
<div>
  <div class="KamerGroProgramFront">
    <h1><?php echo $category['name'] ?> </h1>


    <?php if ($category['ticket_url']) : ?>
      <a href="<?php echo $category['ticket_url'] ?>" target="_blank">Ticket: Passe-partout</a>
    <?php endif ?>
    <!-- Dates -->
    <div class="dates">

      <?php foreach ($dates as $date) : ?>
        <div class="date ">
          <h2><?php echo  $date['name'] ?></h2>
          <a href="<?php echo $date['ticket_url'] ?>" target="_blank">Dagkaart <?php echo  $date['name'] ?> </a>


          <!-- Events -->
          <?php $eventClass = 'onevenEvent' ?>
          <?php foreach ($date['medias'] as $event) : ?>
            <div class="event  <?php echo $eventClass ?> ">
              <div class="eventPhoto">
                <img src="/wp-content/plugins/kamergroprogram/images/categoryThumbnails/<?php echo $event['id']  ?>.png?random=<?php echo uniqid() ?>">
              </div>
              <div class="eventText">
                <h3><?php echo KamerGroProgramFront::truncateString($event['name'], 50) ?></h3>
                <p><?php echo KamerGroProgramFront::truncateString($event['text'], 245); ?></p>



              </div>
              <div class="buttons_wrapper">
                <p class="buttons">
                  <?php if ($event['ticket_url']) : ?>
                    <a href="<?php echo $event['ticket_url'] ?>" target="_blank">Tickets </a>
                  <?php endif ?>
                  <?php if ($event['event_page_url']) : ?>
                    <a href="<?php echo $event['event_page_url'] ?>">Meer info </a>
                  <?php endif ?>
                  &nbsp;
                </p>
              </div>
              <div class="clearBoth">&nbsp;s</div>
            </div>
            <?php $eventClass = $eventClass == '' ? 'onevenEvent'  : '' ?>
            <div style="clear: both;"></div>
          <?php endforeach ?>
          <!--end Events -->

        </div>

      <?php endforeach ?>
      <!--end Dates -->

    </div>
  </div>