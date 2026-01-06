<?php

namespace Kamergro\Models;

use Kamergro\Factory\FModel;

class Item extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'kamergro_program_item';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $categoryId;


    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $ticketUrl;


    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $thumbnail;

    /**
     * @var int
     */
    protected $ordering;


    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;


    /**
     * category
     */
    public function category(array $item): array
    {
        $category  = current(
            $this->oneToMany(
                $item['category_id'],
                'id',
                FModel::build('Category')
            )
        );
        return $category;
    }

    /**
     * medias
     */
    public function medias(array $item): array
    {
        $medias  = $this->oneToMany(
            $item['id'],
            'item_id',
            FModel::build('Media'),
            [
                'orderBy' => [['field' => ' ordering', 'dir' => 'asc']]
            ]

        );
        return $medias;
    }


    /**
     * Insert
     */
    public function insert(array $columns, bool $filterColumns = true): ?int
    {
        $columns['ordering'] = $this->maxOrdering(['column' => 'category_id', 'value' => $columns['category_id']]) + 1;
        return parent::insert($columns, $filterColumns);
    }


    /**
     * Delete
     */
    public function delete($value, string $column = 'id'): void
    {
        /** @var  Media $mMedia*/
        $mMedia = FModel::build('Media');
        $medias = $this->medias(['id' => $value]);
        if (!empty($medias)) {
            foreach ($medias as $media) {
                $mMedia->delete($media['id']);
            }
        }

        $item = current($this->get($value));
        parent::delete($value);
        $this->updateOrdering($item['category_id'], 'category_id');
    }
}
