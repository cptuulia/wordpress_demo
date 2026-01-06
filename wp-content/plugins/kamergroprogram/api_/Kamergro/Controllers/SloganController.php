<?php

namespace Kamergro\Controllers;

use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Services\SloganService;
use Kamergro\Traits\TResponse;

class SloganController extends BaseController
{
    /**
     * @var SloganService
     */
    private $SloganService;


    /**
     * __construct
     */
    public function __construct(array $request = [])
    {
        parent::__construct($request);
        $this->SloganService = new SloganService();
    }

    /**
     * Index
     */
    public function index(): array
    {
        $Slogan = $this->SloganService->search(null);
        return $this->response(
            [
                'count' => count($Slogan),
                'data' => $Slogan
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
                [
                    'errors' => $errors,
                ],
                TResponse::$BadRequest
            );
        }
        $slogan = $this->SloganService->store($this->request);

        return $this->response(
            [
                'message' => 'Inserted',
                'data' => $slogan
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
                [
                    'errors' => $errors,
                ],
                TResponse::$BadRequest
            );
        }
        $slogan = $this->SloganService->update($this->request);
        return $this->response(
            [
                'message' => 'Updated',
                'data' => $slogan
            ]
        );
    }

    /**
     * destroy
     */
    public function destroy(): array
    {
        $this->SloganService->delete($this->request['id']);
        return $this->response(
            [
                'message' => 'Slogan with id ' . $this->request['id'] . ' is deleted.',
            ]
        );
    }

    /**
     * show
     */
    public function show(): array
    {
        $slogan = $this->SloganService->show($this->request['id']);

        if (empty($slogan)) {

            (new Status\NotFound([
                'message' => 'Slogan with id ' . $this->requestUriParam . ' not found',
            ]))->send();
            return [];
        }

        return $this->response(
            [
                'message' => 'Slogan with id ' . $this->requestUriParam,
                'data' => $slogan
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

            'text' => [
                'label' => 'text',
                'type' => self::$VALIDATE_STRING,
                'required' => true,
            ]
        ];

        return $rules;
    }
}
