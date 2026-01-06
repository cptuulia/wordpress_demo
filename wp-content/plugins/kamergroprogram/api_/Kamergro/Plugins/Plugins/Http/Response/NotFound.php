<?php


namespace Kamergro\Plugins\Http\Response;


use Kamergro\Plugins\Http\JsonStatus;

class NotFound extends JsonStatus
{
    /**
* 
     *
 * @var int 
*/
    const STATUS_CODE = 404;
    /**
* 
     *
 * @var string 
*/
    const STATUS_MESSAGE = 'Not found';

    /**
     * Constructor of this class
     *
     * @param mixed $body
     */
    public function __construct($body = '')
    {
        parent::__construct(self::STATUS_CODE, self::STATUS_MESSAGE, $body);
    }
}
