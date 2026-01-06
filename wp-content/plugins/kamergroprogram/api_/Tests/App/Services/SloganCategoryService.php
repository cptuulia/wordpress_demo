<?php

namespace Kamergro\Services;


class SloganCategoryService extends BaseService
{
    protected $modelName = 'SloganCategory';

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Search
     */
    public function search(?int $id, array $options = []): array
    {

        $options = array_merge(
            [
                'order' => [
                    'name' => 'asc',
                ],
                'with' => ['slogans'],
            ],
            $options
        );

        
        return $this->model->get(
            $id,
            $options
        );
    }

    /**
     * Show
     */
    public function show(int $id): array
    {
        return $this->model->get($id, ['with' => ['slogans']]);
    }


    /**
     * Delete
     */
    public function delete(int $id): void
    {
        $this->model->delete($id);
    }

    /**
     * Store
     */
    public function store(array $request): array
    {
        $id = $this->model->insert($request);
        return $this->show($id);
    }

    /**
     * Update
     */
    public function update(array $request): array
    {
       
        $this->model->update($request);
        return $this->show($request['id']);
    }
}
