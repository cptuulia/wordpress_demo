<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;
use Kamergro\Factory\FService;
use Kamergro\Models\Item;
use Kamergro\Models\Media;


class ItemService extends BaseService
{
    protected $modelName = 'Item';

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
    public function search(int $id, array $options = []): array
    {
        $options = array_merge(
            [
                'column' => 'category_id',
                'order' => [
                    'ordering' => 'asc',
                ],
                'with' => ['medias'],
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
        return $this->model->get($id, ['with' => ['category', 'medias']]);
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
        $request['thumbnail'] = '/wp-content/plugins/kamergroProgram/images/logo_green.png';
        $id = $this->model->insert($request);
        return $this->show($id);
    }

    /**
     * Update
     */
    public function update(array $request): array
    {
        $this->model->update($request);
        if (isset($request['mediaOrdering'])) {
            /** @var Media  $mMedia */
            $mMedia = FModel::build('Media');
            foreach ($request['mediaOrdering'] as $media) {
                $mMedia->update(['id' => $media['id'], 'ordering' => $media['ordering'],]);
            }
        }
        return $this->show($request['id']);
    }
}
