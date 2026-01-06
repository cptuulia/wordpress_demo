<?php


namespace Kamergro\Controllers;

use Kamergro\Plugins\Di\Injectable;
use Kamergro\Traits\TRequest;
use Kamergro\Traits\TResponse;
use Kamergro\Traits\TValidate;

/**
 * @property Kamergro\Plugins\Db\Db $db
 */
abstract class BaseController extends Injectable
{
    use TRequest;
    use TResponse;
    use TValidate;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var array
     */
    protected $queryParams;

    /**
     * @var int
     */
    protected $requestUriParam;

    /** @var bool */
    protected $isApiCall;

    /**
     * @param null|array $request
     * @throws \Exception
     */
    public function __construct($request = [])
    {
        $this->isApiCall = empty($request);
        $this->request = empty($request) ? $this->getRequest() : $request;
        $this->queryParams = !empty($request) ? $request : $this->getQueryParams();
        $this->requestUriParam = $this->getUriParam();
    }

    protected abstract function getValidationRules(): array;

    protected function paginationResponse(array $paginatedItems): array
    {
        $response = $paginatedItems;
        unset ($response['items']);
        $response['data'] = $paginatedItems['items'];
        return $response;
    }
}
