<?php

namespace Kamergro\Controllers;

use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Services\MediaService;
use Kamergro\Traits\TResponse;

class MediaController extends BaseController
{
    /**
     * @var MediaService
     */
    private $MediaService;


    /**
     * __construct
     */
    public function __construct(array $request = [])
    {
        parent::__construct($request);
        $this->MediaService = new MediaService();
    }

    /**
     * Index
     */
    public function index(): array
    {
        $Media = $this->MediaService->search(null);
        return $this->response(
            [
                'count' => count($Media),
                'data' => $Media
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
        $this->fixQuotes();
        $media = $this->MediaService->store($this->request);

        return $this->response(
            [
                'message' => 'Inserted',
                'data' => $media
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
        $this->fixQuotes();
        $media = $this->MediaService->update($this->request);
      
        return $this->response(
            [
                'message' => 'Updated',
                'data' => $media
            ]
        );
    }

    /**
     * destroy
     */
    public function destroy(): array
    {
        $this->MediaService->delete($this->request['id']);
        return $this->response(
            [
                'message' => 'Media with id ' . $this->request['id'] . ' is deleted.',
            ]
        );
    }

    /**
     * show
     */
    public function show(): array
    {
        $media = $this->MediaService->show($this->request['id']);

        if (empty($media)) {

            (new Status\NotFound([
                'message' => 'Media with id ' . $this->requestUriParam . ' not found',
            ]))->send();
            return [];
        }

        return $this->response(
            [
                'message' => 'Media with id ' . $this->requestUriParam,
                'data' => $media
            ]
        );
    }

    /**
     * getValidationRules
     */
    protected function getValidationRules(): array
    {
        $rules = [
            'item_id' => [
                'label' => 'item_id',
                'type' => self::$VALIDATE_INTEGER,
                'required' => true,
            ],

            'name' => [
                'label' => 'name',
                'type' => self::$VALIDATE_STRING,
                'required' => true,
            ]
        ];

        if (isset($this->request['type'])) {
            if ($this->request['type'] != 'IMAGE') {
                $rules['url'] =  [
                    'label' => 'url',
                    'type' => self::$VALIDATE_STRING,
                    'required' => true,
                ];
            }
        }
        
        return $rules;
    }

    /**
     * Fix quotes
     * 
     * This function is here instead of in MediaService because  FTP does not update it
     *  kamermuziekfestivalgroningen server and I have no time to solve it
     */
    private function fixQuotes(): void
    {
        $columns = ['name', 'text'];
        foreach ($columns as $column) {
            if (isset($this->request[$column])) {

                $this->request[$column] = str_replace('\"', '"',    $this->request[$column]);
                $this->request[$column] = str_replace("\'", ' &apos;',    $this->request[$column]);
            }
        }
    }
}
