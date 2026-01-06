<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;
use Kamergro\Factory\FService;
use Kamergro\Models\Category;


class CategoryService extends BaseService
{


    protected $modelName = 'Category';

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
                    'name' => 'asc',
                ],
                'with' => ['items']
            ]
        );
    }

    /**
     * Show
     */
    public function show(int $id): array
    {
        $category = $this->model->get($id, ['with' => ['items']]);
        return $category;
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
         if (isset($request['itemOrdering'])) {
            /** @var Item  $mItem */
            $mItem = FModel::build('Item');
            foreach ($request['itemOrdering'] as $item) {
                $mItem->update(['id' => $item['id'], 'ordering' => $item['ordering'],]);
            }
        }
        return $this->show($request['id']);
    }
}
