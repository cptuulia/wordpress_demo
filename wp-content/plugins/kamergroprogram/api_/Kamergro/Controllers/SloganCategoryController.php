<?php

namespace Kamergro\Controllers;

use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Services\SloganCategoryService;
use Kamergro\Traits\TResponse;


class SloganCategoryController extends BaseController
{
    /**
     * @var SloganCategoryService
     */
    private $SloganCategoryService;


    /**
     * __construct
     */
    public function __construct(array $request = [])
    {
        parent::__construct($request);
        $this->SloganCategoryService = new SloganCategoryService();
    }

    /**
     * Index
     */
    public function index(): array
    {
        $Categories = $this->SloganCategoryService->search(null);
        return $this->response(
            [
                'count' => count($Categories),
                'data' => $Categories
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
        $item = $this->SloganCategoryService->store($this->request);
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
        $item = $this->SloganCategoryService->update($this->request);
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
        $this->SloganCategoryService->delete($this->request['id']);
        return $this->response(
            [
                'message' => 'SloganCategory with id ' . $this->requestUriParam . ' is deleted.',
            ]
        );
    }

    /**
     * show
     */
    public function show(): array
    {
        $item = $this->SloganCategoryService->show($this->request['id']);

        if (empty($item)) {

            (new Status\NotFound([
                'message' => 'SloganCategory with id ' . $this->request['id'] . ' not found',
            ]))->send();
            return [];
        }

        return $this->response(
            [
                'message' => 'SloganCategory with id ' . $this->request['id'],
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
            'name' => [
                'label' => 'name',
                'type' => self::$VALIDATE_STRING,
                'required' => true,
            ],
        ];

        return $rules;
    }
}
