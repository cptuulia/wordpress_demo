<?php

namespace Commands\Traits;

use Kamergro\Lib\DbConnection as Connection;
use Kamergro\Plugins;
use Kamergro\Plugins\Db\Db;

trait TDatabase
{
    /**
     * Set database connection
     *
     * @return void
     */
    private function setDatabaseConnection(string $env = ''): void
    {
        $this->db = Connection::getConnection($env);
    }


}