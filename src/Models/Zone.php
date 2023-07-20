<?php

namespace Model;

use Helper\DB;
use PDO;

class Zone
{
    public static function getZoneByCode(string $code)
    {
        $query = "SELECT * FROM zone WHERE code = ?";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute([$code]);

        return $res->fetch(PDO::FETCH_ASSOC) ?: [];
    }
    public static function getZoneById(int $id): array
    {
        $query = "SELECT * FROM zone WHERE id = ?";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute([$id]);

        return $res->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public static function getAllZones(): array
    {
        $query = "SELECT * FROM zone";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute();

        return $res->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}