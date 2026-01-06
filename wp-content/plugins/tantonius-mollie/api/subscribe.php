<?php
/**
 *  This is page to create a Mollie subscription
 * 
 * See how to test on
 * https://docs.google.com/document/d/1FtxjyX1QuVbI9RdEVyr5kP8ntSImnF7lPA1sQub5r4Q/edit?tab=t.0
 */



require_once('api.php');


use App\Mollie;
use App\Response;

  try {

   $customer =  Mollie::subscribe(); 
  } catch (Exception $e) {
    Response::send(
      ['error' => $e->getMessage()],
      Response::HTTP_BAD_REQUEST
    );
  }

  $response = [
    'message' => 'Subscription done ',
    'customer' => $customer,
  ];
Response::send($response);

