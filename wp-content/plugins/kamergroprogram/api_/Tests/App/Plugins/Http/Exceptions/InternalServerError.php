<?php

namespace Kamergro\Plugins\Http\Exceptions;

use Kamergro\Plugins\Http;

class InternalServerError extends Http\ApiException
{
    /**
     * Constructor of this class
     *
     * @param mixed $body
     */
    public function __construct($body = '')
    {
        parent::__construct(new Http\Response\InternalServerError($body));
    }
}
