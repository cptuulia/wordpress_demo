<?php

namespace App;

use App\WpOtions;
use App\Mollie;
use stdClass;
use TaMollieTranslations;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once  __DIR__ .  '/../../lib/TaMollieTranslations.php';
class Email
{
    private static string $NAME = '[NAME]';
    private static string $EMAIL = '[EMAIL]';
    private static string $CLIENT_ID = '[CLIENT_ID]';
    private static string $AMOUNT = '[AMOUNT]';
    private static string $SUBSCRIPTION_TYPE = '[SUBSCRIPTION_TYPE]';
    private static string $CANCELLATION_LINK = '[CANCELLATION_LINK]';

    /**
     * welcomeMail
     */
    public static function welcomeMail(stdClass $customer): void
    {
        $customerData = Mollie::getCustomer($customer->id);
        $placeholders = [
            self::$CLIENT_ID => $customer->id,
            self::$NAME => $customerData['name'],
            self::$EMAIL =>  $customerData['email'],
            self::$AMOUNT =>  $customerData['subscriptions'][0]['amount']['value'] . ' '  . $customerData['subscriptions'][0]['amount']['currency'],
            self::$SUBSCRIPTION_TYPE  => $customerData['subscriptions'][0]['description'],
            self::$CANCELLATION_LINK => self::cancelLink($customer->id),
        ];
       
        self::mailAlert($customerData);
      
        self::send($customer, 
        self::getBody('welcome_mail', $placeholders),
        self::getSubject('welcome_mail')
        )
        ;
    }

     /**
     * payment Mail
     * 
     * This mail is sent
     */
    public static function paymentMail(string $customerId): void
    {
        $customerData = Mollie::getCustomer($customerId);

        $placeholders = [
            self::$CLIENT_ID => $customerId,
            self::$NAME => $customerData['name'],
            self::$EMAIL =>  $customerData['email'],
            self::$AMOUNT =>  $customerData['subscriptions'][0]['amount']['value'] . ' '  . $customerData['subscriptions'][0]['amount']['currency'],
            self::$SUBSCRIPTION_TYPE  => $customerData['subscriptions'][0]['description'],
            self::$CANCELLATION_LINK => self::cancelLink($customerId),
        ];

        self::send( (object)$customerData, 
        self::getBody('payment_mail', $placeholders),
        self::getSubject('payment_mail')
        );
    }

    /**
     * cancelMail
     */
    public static function cancelMail(stdClass $customer): void
    {
        $customerData = Mollie::getCustomer($customer->id);
        $placeholders = [
            self::$CLIENT_ID => $customer->id,
            self::$NAME => $customerData['name'],
            self::$EMAIL =>  $customerData['email'],
            self::$AMOUNT =>  $customerData['subscriptions'][0]['amount']['value'] . ' '  . $customerData['subscriptions'][0]['amount']['currency'],
            self::$SUBSCRIPTION_TYPE  => $customerData['subscriptions'][0]['description'],
          
        ];

         self::mailAlert($customerData, 'cancel');
        self::send($customer, 
        self::getBody('cancel_mail', $placeholders),
        self::getSubject('cancel_mail')
        );
    }

    /**
     * getBody
     */
    private static function getBody(string $identifier, array $placeholders): string
    {
        $options = WpOtions::mollie();
        $body = $options[$identifier];
        foreach ($placeholders as $key => $placeholder) {
            $body = str_replace($key, $placeholder, $body);
        }
        $body = str_replace("\n", '<br>', $body);
        $body .= self::footer($options ["footer_logo"], $options ["footer_text"]);
        return $body;
    }

     /**
     * getSubject
     */
    private static function getSubject(string $identifier) : string
    {
        $options = WpOtions::mollie();
        return  $options[$identifier. '_subject']; 
    }

    /**
     * send
     */
    public static function send(stdClass $customer, string $body, string $subject): void
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $serverConfig =  WpOtions::mailServer();
        $options = WpOtions::mollie();
      

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       =  $serverConfig["url"];                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure = 'TLS';
            $mail->Username   =  $serverConfig["login"];                    //SMTP username
            $mail->Password   =  $serverConfig["pass"];                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       =  $serverConfig["port"];                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($options["from_email"], $options["from_name"]);
            $mail->addAddress($customer->email,  $customer->name);
            $mail->addReplyTo($options["reply_email"], $options["reply_name"]);


            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
        } catch (Exception $e) {
            throw new Exception($mail->ErrorInfo);
            return;
        }
    }


    /**
     * Footer
     */
    public static function footer(?string $logoUrl, ?string $text): string
    {

        ob_start();
        include_once(__DIR__ . '/../style/email.php');
        $footer = ob_get_clean();

        $footer .=  '<div id = "TaMollieEmailFooter">';
        if ($logoUrl != '') {
            $footer .= '<img src="' . $logoUrl . '"</img>';
        }

        if ($text != '') {
            $footer .= '<p>' . str_replace("\n", '<br>', $text) . '</p>';
        }
        $footer .= '<div style="clear:both"></div></div><div style="clear:both"></div>';

        return $footer;
    }

    /**
     * Cancel link
     */
    private static function cancelLink(string $clientId): string
    {
        $url = $_SERVER["REQUEST_SCHEME"] . '://' .
            $_SERVER["HTTP_HOST"] .
            '/wp-content/plugins/tantonius-mollie/pages/cancel.php?cancelsubscription=' . $clientId;
        return '<a href="' . $url . '">' . TaMollieTranslations::trns('__CANCEL_SUBSCRIPTION__') . '</a>';
    }

    private static function mailAlert(array $customer, string $type = 'subscribe')
    {
        $options = WpOtions::mollie();
     
      $link = 'https://my.mollie.com/dashboard/'. $options["client_id"].
       '/customers/'. $customer ["id"];
        $subject = $type == 'subscribe' 
        ? 'New donation on  '. $_SERVER["HTTP_HOST"]
        : 'Donation cancelled on '. $_SERVER["HTTP_HOST"];
        $body = $link . "\n";
        mail ($options ["email_alert"], $subject, $body);
    }
}
