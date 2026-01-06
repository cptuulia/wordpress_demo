<?php

/**
 *  Get data of one client by client id
 * 
 */

require_once('api.php');

use App\Mollie;
use App\Response;


try {

  $customer =  Mollie::getActiveClients();
} catch (Exception $e) {
  Response::send(
    ['error' => $e->getMessage()],
    Response::HTTP_BAD_REQUEST
  );
}

$response =  $customer;
Response::send($response);
