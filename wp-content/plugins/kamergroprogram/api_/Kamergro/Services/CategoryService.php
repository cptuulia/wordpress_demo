<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;
use Kamergro\Factory\FService;
use Kamergro\Models\Category;
use Kamergro\Services\ItemService;


class CategoryService extends BaseService
{


    private ItemService $itemService;
    protected $modelName = 'Category';

    /**
     * Construct
     */
    public function __construct()
    {
        $this->itemService = FService::build('ItemService');
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
        $category = current($this->model->get($id, ['with' => ['items']]));
        if (isset($category['items'])) {
            if (!empty($category['items'])) {
                for ($index = 0; $index < count($category['items']); $index++) {
                    $itemId = $category['items'][$index]['id'];
                    $item = current($this->itemService->show($itemId));
                    $category['items'][$index]['medias'] = isset($item['medias']) ? $item['medias'] : [];
                }
            }
        }
        return [ $category];
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
