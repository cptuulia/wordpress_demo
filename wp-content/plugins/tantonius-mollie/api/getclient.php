<?php

/**
 *  Get data of one client by client id
 * 
 */

require_once('api.php');

use App\Mollie;
use App\Response;

if (isset($_REQUEST['customerId'])) {
  try {

    $customer =  Mollie::getCustomer($_REQUEST['customerId']);
  } catch (Exception $e) {
    Response::send(
      ['error' => $e->getMessage()],
      Response::HTTP_BAD_REQUEST
    );
  }

  $response =  $customer;
  Response::send($response);
}


?>
<?php $redirectUrl = $_SERVER["HTTP_X_FORWARDED_PROTO"] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>

<form method="post">
  clientID <input name='customerId' value='' /><br>
  <input type="submit" value="send" /><br>
</form>