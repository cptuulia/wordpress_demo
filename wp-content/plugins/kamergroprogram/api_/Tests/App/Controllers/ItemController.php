<?php

namespace Kamergro\Controllers;

use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Services\ItemService;
use Kamergro\Traits\TResponse;


class ItemController extends BaseController
{
    /**
     * @var ItemService
     */
    private $ItemService;


    /**
     * __construct
     */
    public function __construct(array $request = [])
    {
        parent::__construct($request);
        $this->ItemService = new ItemService();
    }

    /**
     * Index
     */
    public function index(): array
    {
        $options  = [
            'paginate' => [
                'current_page'   =>  isset($this->queryParams['currentPage'])
                    ? $this->queryParams['currentPage'] - 1 : 0,
                'page_size'    => isset($this->queryParams['pageSize'])
                    ? $this->queryParams['pageSize'] : 15,
            ]
        ];
        $categoryId = $this->requestUriParam 
            ? $this->requestUriParam : $this->queryParams['categoryId'];
        $Item = $this->ItemService->search($categoryId, $options);
        return $this->response(
            [
                'count' => $Item['items_count'],
                'data' => $Item
            ]
        );
    }

    /**
     * store
     */
    public function store(): array
    {
        $errors = $this->validate();
        if (!empty($errors)) {
            return $this->response(
                ['errors' => $errors,],
                TResponse::$BadRequest
            );
        }
        $item = $this->ItemService->store($this->request);
         return $this->response(
            [
                'message' => 'Inserted',
            'data' => $item
            ]
        );
        
    }

    /**
     * Update
     */
    public function update(): array
    {
        $errors = $this->validate();
        if (!empty($errors)) {
            return $this->response(
                ['errors' => $errors,],
                TResponse::$BadRequest
            );
        }
        $item = $this->ItemService->update($this->request);
        return $this->response(
            [
                'message' => 'Updated',
                'data' => $item
            ]
        );
    }

    /**
     * destroy
     */
    public function destroy(): array
    {
        $this->ItemService->delete($this->request['id']);
        return $this->response(
            [
                'message' => 'Item with id ' . $this->requestUriParam . ' is deleted.',
            ]
        );
    }

    /**
     * show
     */
    public function show(): array
    {
        $item = $this->ItemService->show($this->request['id']);

        if (empty($item)) {

            (new Status\NotFound([
                'message' => 'Item with id ' . $this->request['id'] . ' not found',
            ]))->send();
            return [];
        }

        return $this->response(
            [
                'message' => 'Item with id ' . $this->request['id'],
                'data' => $item
            ]
        );
    }

    /**
     * getValidationRules
     */
    protected function getValidationRules(): array
    {
        $rules = [
            'category_id' => [
                'label' => 'category_id',
                'type' => self::$VALIDATE_INTEGER,
                'required' => true,
            ],
            'name' => [
                'label' => 'name',
                'type' => self::$VALIDATE_STRING,
                'required' => true,
            ],
        ];

        return $rules;
    }
}
