<?php

namespace Kamergro\Models;

use Kamergro\Factory\FModel;
use Kamergro\Enums\EMatchType;

/**
 * Model  to handle Tags
 */
class Media extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'kamergro_program_item_media';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $itemId;


    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $ticketUrl;

     /**
     * @var string
     */
    protected $eventPageUrl;
    

    /**
     * @var string
     */
    protected $url;

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
     * item
     */
    public function item(array $item): array
    {
        $category  = current(
            $this->oneToMany(
                $item['item_id'],
                'id',
                FModel::build('Item')
            )
        );
        return $category;
    }


    public function insert(array $columns, bool $filterColumns = true): ?int
    {
        $columns['ordering'] = $this->maxOrdering(['column' => 'item_id', 'value' => $columns['item_id']]) + 1;
        return parent::insert($columns, $filterColumns);
    }

    /**
     * Delete
     */
    public function delete($value, string $column = 'id'): void
    {
        $media = current($this->get($value));
        parent::delete($value);
        $this->updateOrdering($media['item_id'], 'item_id');
    }
}
