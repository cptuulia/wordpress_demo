<?php

namespace App\Mollie;

use App\Factory\FModel;
use App\Factory\FService;
use Mollie\Api\Utils\Arr;
use App\Models\TaMollieSubscriptions;
use Forminator\Stripe\Subscription;

trait Synchronize
{

    static private  TaMollieSubscriptions $mSubsriptions;
    /**
     * synchronize
     *
     * @return void
     */
    public static function synchronize(): void
    {
        $clientIdsInDatabase = self::clientsInDatabase();
        $activeClientsInMollie = self::activeMollieClients();

        // Add new clients
        foreach ($activeClientsInMollie as $client) {
            if (!in_array($client->id, $clientIdsInDatabase)) {

                /**  @var TaMollieSubscriptions $object  */
                $object = FModel::build('TaMollieSubscriptions');
                $object->insert(
                    [
                        'customer_id' => $client->id,
                        'subscription_id' => $client->subscriptionId,
                        'name' => $client->name,
                        'email' => $client->email,
                    ]
                );
            }
        }
       
        
        // Remove non active clients
        $activeClientIdsInMollie = array_map(
            function ($item) {
                return $item->id;
            },
            $activeClientsInMollie
        );
        foreach ($clientIdsInDatabase as $clientId) {
            if (!in_array($clientId, $activeClientIdsInMollie)) {
                  /**  @var TaMollieSubscriptions $object  */
                $object = FModel::build('TaMollieSubscriptions');
                $object->delete($clientId, 'customer_id');
            }
        }
    }


    /**
     * Get clients in our database as an array of clients ids
     *
     * @return array
     */
    private static function clientsInDatabase(): array
    {
        /**  @var TaMollieSubscriptions $object  */
        $object = FModel::build('TaMollieSubscriptions');
        $clients = array_map(
            function ($item) {
                return $item['customer_id'];
            },
            $object->get()
        );
        return $clients;
    }


    /**
     * Get active clients from Mollie
     *
     * @return array
     */
    private  static function activeMollieClients(): array
    {
        $activeClients = [];
        foreach (self::getCustomers() as $client) {
            $subscriptions = self::getClientSubscriptions($client->id);
            $subscriptionId= null;
            foreach ($subscriptions as $subscription) {
                if ($subscription->status == 'active') {
                 
                    $subscriptionId = $subscription->id;
                    
                }
            }
            if (!is_null($subscriptionId)) {
                $client->subscriptionId = $subscriptionId;
                $activeClients[] = $client;
            }
        }
        return $activeClients;
    }
}
