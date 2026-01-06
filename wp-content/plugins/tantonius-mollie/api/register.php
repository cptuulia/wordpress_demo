<?php

/**
 *  This is page to create a Mollie client registration and mandate, so that we are
 *  able to make a subscription
 * 
 * See how to test on
 * https://docs.google.com/document/d/1FtxjyX1QuVbI9RdEVyr5kP8ntSImnF7lPA1sQub5r4Q/edit?tab=t.0
 */


require_once('api.php');

use App\Mollie;
use App\Response;
use App\WpOtions;

if (!empty($_POST)) {

  try {

    // format test form the format as posted Ajax form
    // ajax format:   ["form" => "{"senderFirstName":"Lotte","senderLastName":"De Jongë","id":"2233" ...}]
    if (isset($_POST['isTestForm'])) {
      $_POST['form'] = json_encode($_POST);
    }

    $paymentLink =  Mollie::register($_POST);
  } catch (Exception $e) {
    Response::send(
      ['error' => $e->getMessage()],
      Response::HTTP_BAD_REQUEST
    );
  }

  $response = [
    'message' => 'Payment link generated ',
    'link' => $paymentLink
  ];

  Response::send($response);
}
 $options = WpOtions::mollie();
$apiKey = $options['mollie_api_key'];
// Render the test form only  on test API key
if (!str_contains($apiKey, 'test')) {
  die;
}
?>
<?php $redirectUrl = $_SERVER["HTTP_X_FORWARDED_PROTO"] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>

<form method="post">

  senderFirstName <input name='senderFirstName' value='Lotte' /><br>
  senderLastName <input name='senderLastName' value='De Jongë' /><br>
  senderEmail <input name='senderEmail' value='test@tantonius.com' /><br>
  senderPhone <input name='senderPhone' value='0612345678' /><br>
  amount<input name='amount' value='232' /><br>

  paymentMethod<br>
  <input type ="radio" name='paymentMethod' value='creditcard'  checked/>creditcard<br>
  <input type ="radio" name='paymentMethod' value='ideal' />ideal<br>
  interval<br>
  name <input name='intervalName' value='Test subscription' /><br>
   <input type="radio" name="interval" value="once">once<br>
  <input type="radio" name="interval" value="3 months"> 3 months<br>
  <input type="radio" name="interval" value="4 months" checked="checked"> 4 months<br>
  <input type="radio" name="interval" value="6 months"> 6 months<br>
  <input type="radio" name="interval" value="12 months"> 12 months<br>
  <input type="hidden" name="isTestForm" value="true">
  <input type="hidden" name="mollieRedirectUrl" value="<?php echo $redirectUrl ?>">
  <input type="submit" value="send" /><br>
</form>