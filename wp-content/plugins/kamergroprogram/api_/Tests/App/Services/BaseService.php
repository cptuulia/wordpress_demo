<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;
use Kamergro\Models\BaseModel;
use Kamergro\Plugins\Db\Db;
use Kamergro\Lib\DbConnection;

abstract class BaseService
{
    /** @var Db  */
    protected $db;

    /**
     * @var string
     */
    protected $modelName;

    /**
     * @var BaseModel
     */
    protected $model;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = DbConnection::getConnection();
        $this->model = FModel::build($this->modelName);
    }
}