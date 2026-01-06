<?php

namespace App\Services;

use App\Factory\FModel;
use App\Factory\FService;
use App\Models\TaMollieSubscriptions;


class TaMollieSubscriptionsService extends BaseService
{


    protected $modelName = 'TaMollieSubscriptions';

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
    public function search(?int $id): array
    {
        return $this->model->get(
            $id,
            [
                'order' => [
                    'email' => 'asc',
                ],
            ]
        );
    }

    /**
     * Show
     */
    public function show(int $id): array
    {
        return $this->model->get($id);
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
