<?php

namespace App\Models;



class TaMollieSubscriptions extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'ta_mollie_subscriptions';

    /**
     * @var int
     */
    protected $id;


    /**
     * @var string
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $subscriptionId;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;


}
