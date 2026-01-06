<?php

namespace Kamergro\Plugins\Db\Adapters;

use Kamergro\Plugins\Db\IDb;

interface IAdapter
{
    function getDb();

    function setDb(IDb $db);
}
