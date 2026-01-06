<?php

namespace Kamergro\Controllers;

use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Services\CategoryService;
use Kamergro\Traits\TResponse;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    private $CategoryService;


    /**
     * __construct
     */
    public function __construct(array $request = [])
    {
        parent::__construct($request);
        $this->CategoryService = new CategoryService();
    }

    /**
     * Index
     */
    public function index(): array
    {
        $Category = $this->CategoryService->search(null);
        return $this->response(
            [
                'count' => count($Category),
                'data' => $Category
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
        $category = $this->CategoryService->store($this->request);
        return $this->response(
            [
                'message' => 'Inserted',
                'data' => $category
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
        $category = $this->CategoryService->update($this->request);
        return $this->response(
            [
                'message' => 'Updated',
                'data' => $category
            ]
        );
    }

    /**
     * destroy
     */
    public function destroy(): array
    {
        $this->CategoryService->delete($this->request['id']);
        return $this->response(
            [
                'message' => 'Category with id ' . $this->requestUriParam . ' is deleted.',
            ]
        );
    }

    /**
     * show
     */
    public function show(): array
    {
        $category = $this->CategoryService->show($this->request['id']);

        if (empty($category)) {
            return $this->response(
                [
                    'message' => 'Item with id ' . $this->request['id'] . ' not found',
                ],
                TResponse::$NotFound
            );
        }

        return $this->response(
            [
                'message' => 'Item with id ' . $this->requestUriParam,
                'data' => $category
            ]
        );
    }

    /**
     * getValidationRules
     */
    protected function getValidationRules(): array
    {
        $rules = [
            'name' => [
                'label' => 'label',
                'type' => self::$VALIDATE_STRING,
                'required' => true,
            ],
        ];

        return $rules;
    }
}
