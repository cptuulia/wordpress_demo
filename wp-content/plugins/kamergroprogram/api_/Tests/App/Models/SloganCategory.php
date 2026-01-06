<?php

namespace Kamergro\Models;

use Kamergro\Factory\FModel;

class SloganCategory extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'kamergroProgram_slogan_category';

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
     * slogans
     */
    public function slogans(array $item): array
    {
        $slogans  = $this->oneToMany(
            $item['id'],
            'category_id',
            FModel::build('Slogan')

        );
        return $slogans;
    }

    /**
     * Delete
     */
    public function delete($value, string $column = 'id'): void
    {
        /** @var  Slogan $mSlogan*/
        $mSlogan = FModel::build('Slogan');
        $slogans = $this->slogans(['id' => $value]);
        if (!empty($slogans)) {
            foreach ($slogans as $slogan) {
                $mSlogan->delete($slogan['id']);
            }
        }
        parent::delete($value);
    }
}
