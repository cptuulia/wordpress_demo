<?php

/**
 * https://docs.mollie.com/docs/recurring-payments
 */

namespace App;

use Exception;
use Mollie\Api\Http\Data\Money;
use Mollie\Api\Resources\Customer;
use Mollie\Api\Resources\Payment;
use Mollie\Api\Resources\Subscription;
use Mollie\Api\Http\Requests\CancelSubscriptionRequest;
use Mollie\Api\Http\Requests\GetPaginatedCustomerRequest;
use Mollie\Api\Http\Requests\GetAllPaginatedSubscriptionsRequest;
use Mollie\Api\Http\Requests\GetPaginatedSubscriptionsRequest;
use Mollie\Api\Http\Requests\GetCustomerRequest;
use Mollie\Api\Http\Requests\GetSubscriptionRequest;
use Mollie\Api\Http\Requests\RevokeMandateRequest;
use Mollie\Api\Http\Requests\CreatePaymentRequest;

use App\Mollie\Synchronize;
use App\Session;
use App\TaDbConnect;
use App\Email;
use App\WpOtions;
use stdClass;
use App\Factory\FModel;
use App\Models\TaMollieSubscriptions;

class Mollie
{
      use Synchronize;
    /** 
     * Register a new client and make first payment link
     * 
     *  
     */
    public static function register(array $data): array
    {
        Session::setPaymentData([]);
        $data = json_decode($data['form'], true);

        if ($data['interval'] == 'once') {
            $payment = self::oneTimePayment($data);
        } else {
            $redirectUrl =  $data["mollieRedirectUrl"];
            $customer = self::createCustomer($data);
            $customerId = $customer->id;
            $data['customerId'] = $customerId;
            Session::setPaymentData($data);
            $payment = self::makeMandate($customerId, $redirectUrl);
        }

        return [
            'customer_id' => $customerId,
            'link' => $customer->_links->self->href,
            'payment_link' =>  $payment->getCheckoutUrl()
        ];
    }

    /**
     * Create customer
     */
    private static function createCustomer(array $data) {
           $mollie = self::getMollieConnection();
            $params = [
                "name" => $data["senderFirstName"] . ' ' . $data["senderLastName"],
                "email" =>  $data["senderEmail"]
            ];
            $customer = $mollie->customers->create($params);
            return $customer;
    }

    /**
     * Subscribe for the given customer Id
     * 
     * https://github.com/mollie/mollie-api-php/blob/master/docs/payments.md
     */
    public static function subscribe(): array
    {
        $data = Session::getPaymentData();
        $requestsCounter = 0;
        while ($requestsCounter < 4) {
            sleep(3);
            $mollieCustomerData = self::getCustomer($data['customerId']);
            $requestsCounter = is_null($mollieCustomerData['validMandate']['id']) ? $requestsCounter + 1 : 1000;
        }
        if (is_null($mollieCustomerData['validMandate']['id'])) {
            throw new Exception(json_encode(['message' => 'no valid mandate']));
        }

        $customerId = $data["customerId"];
        $amount = number_format((float)$data["amount"], 2, '.', '');
        $interval = $data["interval"];
        $intervalName = $data["intervalName"];

        $mandateId = $mollieCustomerData['validMandate']['id'];
      
        $requestsCounter = 0;
        $subscription = null;
        $subscriptionException = null;
        while ($requestsCounter < 4) {

            $mollie = self::getMollieConnection();
            $params = [
                "amount" => [
                    "currency" => "EUR",
                    "value" => $amount
                ],
                "times" => 100,
                "mandateId" =>  $mandateId,
                "interval" => $interval,
                "description" => $intervalName,
                "webhookUrl" => self::paymentWebhookUrl($customerId)
            ];

            if (Session::getPaymentData()["paymentMethod"] == 'ideal') {
                //  $params['method'] = "ideal";
            }

            $subscriptionException = null;
            try {
                $subscription = $mollie->subscriptions->createForId($customerId, $params);
            } catch (Exception $e) {
                $subscriptionException = $e;
                sleep(3);
            }
            $requestsCounter = is_null($subscriptionException) ? 1000 : $requestsCounter + 1;
        }

        if ($subscriptionException) {
            throw $subscriptionException;
        } else {
            Email::welcomeMail((object)$mollieCustomerData);
            $subscriptionId = $subscription->getResponse()->json()->id;
            $description =  $subscription->getResponse()->json()->description;
            $name = $data["senderFirstName"] . ' ' .  $data["senderLastName"];
            $sql = 'INSERT INTO ta_mollie_subscriptions (customer_id, 	subscription_id, `name`,  email)
                VALUES (
                "' . $customerId . '" , 
                "' . $subscriptionId . '",
               "' . $name . '",
                "' . $data["senderEmail"] . '"
                )';
            TaDbConnect::connect()->query($sql);
        }
      

        return [
            'customer_id' =>  $customerId,
            'subscription_id' =>  $subscriptionId,
            'description' => $description,
        ];
    }


    /**
     * Payment webhook Url
     */
    private static function paymentWebhookUrl(string $customerId): string
    {
        $url = $_SERVER["REQUEST_SCHEME"] . '://' .
            $_SERVER["HTTP_HOST"] .
            '/wp-content/plugins/tantonius-mollie/api/periodicPaymentEmail.php?customerId=' . $customerId;
        return  $url;
    }

    /**
     * Get customer
     * 
     */
    public static function getCustomer(string $customerId): array
    {
        $customer = self::getCustomerById($customerId);
        $customer = json_decode(json_encode($customer), true);
        return $customer;
    }

    /**
     * Unsubscribe for the given customer Id
     * 
     * https://docs.mollie.com/reference/revoke-mandate
     * https://docs.mollie.com/reference/cancel-subscription
     * 
     */
    public static function unsubscribe(array $data): array
    {
        $mollie = self::getMollieConnection();
        $customerId = $data["customerId"];
        $clientData = self::getCustomer($customerId);

        $subscriptionId = isset($clientData["activeSubscription"])
            ? $clientData["activeSubscription"]['id'] : null; 
  
        if (is_null($subscriptionId)) {
            $message = 'Subscription was already cancelled.';
        } else {
            // Cancel subscription
            $mollie->send(
                new CancelSubscriptionRequest(
                    customerId: $customerId,
                    subscriptionId: $subscriptionId
                )
            );

            // Remove mandate(s)
            $client = self::getCustomerById($customerId);
            if (!empty($client->mandates)) {
                foreach ($client->mandates as $mandate) {
                    $mollie->send(new RevokeMandateRequest(
                        customerId: $customerId,
                        mandateId: $mandate->id
                    ));
                }
            }
            $message = 'subscription cancelled';
            Email::cancelMail(self::getCustomerById($data['customerId']));
        }
        
        // remove from database
        $sql = 'DELETE FROM ta_mollie_subscriptions   WHERE customer_id =  "' . $customerId . '" ';
        $result = TaDbConnect::connect()->query($sql);

        return [
            'message' => $message,
            'customer_id' => $customerId,
            'subscription_id' => $subscriptionId,
        ];

            
    }


    public static function verifyUniqueEmail(string $email): array
    {
        $sql = 'SELECT *  FROM ta_mollie_subscriptions   WHERE email =  "' . $email . '" ';
        $result = TaDbConnect::connect()->query($sql);
        $row = $result->fetch_assoc();
        return ['email_exists' => mysqli_num_rows($result) != 0];
    }

    /**
     * Get customers
     * 
     * https://docs.mollie.com/reference/list-customers
     * 
     * @return array<Customer>
     */
    public static function getCustomers(): array
    {
        $mollie = self::getMollieConnection();
        $customersObj = $mollie->send(new GetPaginatedCustomerRequest());
        $customers = $customersObj->getResponse()->json()->_embedded->customers;
        return $customers;
    }

    public static function getActiveClients(array $options = [])
    {
        self::synchronize();
        /**  @var $d TaMollieSubscriptions */
        $object = FModel::build('TaMollieSubscriptions');
        return $object->get();
    }
    /**
     *  Get customer
     * 
     * https://docs.mollie.com/reference/get-customer
     * 
     * @return stdClass{
     *      mandates: array<stdClass>,
     *      validMandate: ?|<stdClass>,
     *      subscriptions: array<stdClass>,
     *      customer: <stdClass>
     * }  
     */
    private static function getCustomerById(string $customerId): stdClass
    {

        $mollie = self::getMollieConnection();

        $customerObj = $mollie->send(new GetCustomerRequest(id: $customerId));
        $customer = $customerObj->getResponse()->json();
        $mandatesObj = $mollie->customers->get($customerId)->mandates();
        $mandates = $mandatesObj->getResponse()->json()->_embedded->mandates;

        $validMandate = null;
        foreach ($mandates as $mandate) {
            if ($mandate->status == 'valid') {
                $validMandate = $mandate;
                break;
            }
        }
        
        
        $subscriptions = self::getClientSubscriptions($customerId);
        $activeSubscription = null;
         foreach ($subscriptions as $subscription) {
            if ($subscription->status =='active') {
                $activeSubscription = $subscription;
                break;
            }
        }
       
        $customer->mandates = $mandates;
        $customer->validMandate = $validMandate;
        $customer->subscriptions = $subscriptions;
        $customer->activeSubscription = $activeSubscription;
        return $customer;
    }


    /**
     * Get client subscription  by description
     * 
     * https://docs.mollie.com/reference/get-subscription
     * 
     */
    private static function getClientSubscription(string $customerId, string $description): ?Subscription
    {
        $mollie = self::getMollieConnection();
        $subscriptions = self::getClientSubscriptions($customerId);
        $currentSubscription = null;
        if (!empty($subscriptions)) {
            foreach ($subscriptions as $subscription) {
                if ($subscription->description == $description) {
                    $currentSubscription = $subscription;
                }
            }
        }

        if (!is_null($currentSubscription)) {
            $subscription = $mollie->send(
                new GetSubscriptionRequest(
                    customerId: $customerId,
                    id: $currentSubscription->id
                )
            );
            return $subscription;
        }

        return null;
    }


    /**
     * Get client subscriptions 
     * 
     * https://docs.mollie.com/reference/list-subscriptions
     */
    private static function getClientSubscriptions(string $customerId): array
    {
        $mollie = self::getMollieConnection();
        $subscriptions = $mollie->send(
            new GetPaginatedSubscriptionsRequest(
                customerId: $customerId
            )
        );
        return $subscriptions->getResponse()->json()->_embedded->subscriptions;
    }


    /**
     * Get all subscriptions 
     * 
     * https://docs.mollie.com/reference/list-all-subscriptions
     */
    private static function getAllSubscriptions(): array
    {
        $mollie = self::getMollieConnection();
        $subscriptions = $mollie->send(
            new GetAllPaginatedSubscriptionsRequest()
        );
        return $subscriptions->getResponse()->json()->_embedded->subscriptions;
    }

    /**
     * One ttime payment
     */
    private static function oneTimePayment(array $data): Payment
    {
        $mollie = self::getMollieConnection();
        $redirectUrl =  $data["mollieRedirectUrl"];
        $extension =  str_contains($redirectUrl, '?') ? '&' : '?';
        $redirectUrl .= $extension . 'onetimepaymentdone=true';
        $amount = self::getAmount($data["amount"]);;
       

        $params = [
            "amount" => new Money('EUR', $amount),
          
            "description" => 'Donate Power of Reflection',
            "redirectUrl" =>  $redirectUrl,
            "webhookUrl" => "https://webshop.example.org/payments/webhook/"
        ];

        $params['method'] =  $data["paymentMethod"] == 'ideal'
             ? "ideal"  : 'creditcard';
       
        $payment = $mollie->payments->create($params);
        return  $payment;
    }

    /**
     * Make first payment link to create a mandate which authorizes the subscription
     * 
     */
    private static function makeMandate(string $customerId, string $redirectUrl): Payment
    {
        $extension =  str_contains($redirectUrl, '?') ? '&' : '?';
        $redirectUrl .= $extension . 'customerId=' . $customerId . '&mandatedone=true';
        $mollie = self::getMollieConnection();


        $params = [
            "amount" => [
                "currency" => "EUR",
                "value" => "0.01"
            ],
            "customerId" => $customerId,
            "sequenceType" => "first",
            "description" => "First payment for the mandate",
            "redirectUrl" =>  $redirectUrl,
            "webhookUrl" => "https://webshop.example.org/payments/webhook/"
        ];

        $params['method'] =  (Session::getPaymentData()["paymentMethod"] == 'ideal') ? "ideal"  : 'creditcard';
        $payment = $mollie->payments->create($params);
        return  $payment;
    }




    /**
     * getAmount
     */
    private static function getAmount(float $amount): string
    {
        return  number_format((float)$amount, 2, '.', '');
    }


    private static function getMollieConnection()
    {
        $options = WpOtions::mollie();
        $apiKey = $options['mollie_api_key'];
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey($apiKey);
        return $mollie;
    }

}
