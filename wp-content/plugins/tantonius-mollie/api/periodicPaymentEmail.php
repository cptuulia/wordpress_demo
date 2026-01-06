<?php

/**
 *  A webhook page for Mollie, after a periodic payment is done.
 * 
 *  Test by https://powerofreflection.tantonius.com/wp-content/plugins/tantonius-mollie/api/periodicPaymentEmail.php?customerId=XXX
 * 
 */


require_once('api.php');

use App\Email;
use App\Response;


try {
    Email::paymentMail($_GET['customerId']);
} catch (Exception $e) {
    Response::send(
        ['error' => $e->getMessage()],
        Response::HTTP_BAD_REQUEST
    );
}

$response = [
    'message' => 'Email sent ',
];

Response::send($response);
