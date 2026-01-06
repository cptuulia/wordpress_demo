<?php
/**
 *  This is page to unsubscribe Mollie
 * 
 * See how to test on
 * https://docs.google.com/document/d/1FtxjyX1QuVbI9RdEVyr5kP8ntSImnF7lPA1sQub5r4Q/edit?tab=t.0
 */


require_once('api.php');


use App\Mollie;
use App\Response;
if (!empty($_POST)) {

  try {

    // format test form the format as posted Ajax form
    // ajax format:   ["form" => "{"senderFirstName":"Lotte","senderLastName":"De Jongë","id":"2233" ...}]
    if (isset($_POST['isTestForm'])) {
      $_POST['form'] = json_encode($_POST);
    }

    $response =  Mollie::unsubscribe($_POST);
  } catch (Exception $e) {
    Response::send(
      ['error' => $e->getMessage()],
      Response::HTTP_BAD_REQUEST
    );
  }


  Response::send($response);
}
?>
<form method="post">

customerId <input name='customerId' value='' /><br>
  <input type="submit" value="send" /><br>
</form>

