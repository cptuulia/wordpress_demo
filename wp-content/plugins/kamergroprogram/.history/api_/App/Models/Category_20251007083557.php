<?php

namespace Kamergro\Models;

use Kamergro\Factory\FModel;


class Category extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'kamergro_program_category';

    /**
     * @var int
     */
    protected $id;


    /**
     * @var string
     */
    protected $name;


    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;


    /**
     * @return array<Item>
     */
    public function items(array $category): array
    {
        return $this->oneToMany(
            $category['id'],
            'Category_id',
            FModel::build('Item'),
            [
                'orderBy' => [['field' => ' ordering', 'dir' => 'asc']]
            ]
        );
    }

    /**
     * Delete
     */
    public function delete($value, string $column = 'id'): void
    {
         /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        $items = $this->items(['id' => $value]);
        if (!empty($items)) {
            foreach($items as $item) {
                $mItem->delete($item['id']);
            }
        }
        parent::delete($value);

    }
}
