<?php

namespace Kamergro\Models;

use Kamergro\Factory\FModel;
use Kamergro\Enums\EMatchType;

/**
 * Model  to handle Tags
 */
class Slogan extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'kamergroProgram_slogan';

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
    protected $text;

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
    public function category(array $category): array
    {
        $category  = current(
            $this->oneToMany(
                $category['category_id'],
                'id',
                FModel::build('SloganCategory')
            )
        );
        return $category;
    }


    public function insert(array $columns, bool $filterColumns = true): ?int
    {
        $columns['ordering'] = $this->maxOrdering() + 1;
        return parent::insert($columns, $filterColumns);
    }

    /**
     * Delete
     */
    public function delete($value, string $column = 'id'): void
    {
        parent::delete($value);
        $this->updateOrdering();
    }
}
