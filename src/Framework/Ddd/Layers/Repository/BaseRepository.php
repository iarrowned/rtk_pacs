<?php

namespace Framework\Ddd\Layers\Repository;

use Framework\Ddd\Layers\Utils\NamespaceUtil;
abstract class BaseRepository
{

    protected string $tableName;
    public function __construct()
    {
        $this->tableName = NamespaceUtil::getTableName($this::class);
    }

    public function getAll()
    {

    }
}