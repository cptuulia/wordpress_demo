<?php

/**
 * 
 */

namespace App;


class Session
{

    private static string $paymentDataKey= 'payment_data';
   
    /** 
     * Set payment data
     */
    public static function setPaymentData(array $data) : void
    {
        session_start();
        $_SESSION[self::$paymentDataKey] = json_encode($data);
    }

    /** 
     * Get payment data
     */
    public static function getPaymentData() : array
    { 
        session_start();
        return  isset($_SESSION[self::$paymentDataKey]) 
            ? json_decode($_SESSION[self::$paymentDataKey], true)
            : [];
    }

   
    
}
