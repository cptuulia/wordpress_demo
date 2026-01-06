<?php

/**
 *  Verify that the emil is unique in active mollie clients
 * 
 * Test 
 *  wp-content/plugins/mollie/api/verifyEmail.php?email=E_MAIL_TO_CHECK
 */


require_once('api.php');

use App\Mollie;
use App\Response;

try {
  $emailExists =  Mollie::verifyUniqueEmail($_GET['email']);
} catch (Exception $e) {
  Response::send(
    ['error' => $e->getMessage()],
    Response::HTTP_BAD_REQUEST
  );
}

Response::send($emailExists);
