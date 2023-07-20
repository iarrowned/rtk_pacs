<?php

namespace Framework\Ddd\Layers\Utils;

class NamespaceUtil
{
    public static function getTableName(string $namespace): string
    {
        $separatedNames = explode('\\', $namespace);
        $className = $separatedNames[array_key_last($separatedNames)];

        return strtolower(str_replace('Repository', '', $className));
    }
}