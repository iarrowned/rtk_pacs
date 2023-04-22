<?php

namespace Model;

use Helper\DB;
use PDO;

class Rule
{
    public static function getRuleByZoneIds(int $lastZoneId, int $currentZoneId): array
    {
        $query = "SELECT * FROM reglament WHERE last_zone_id = ? AND current_zone_id = ?";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute([$lastZoneId, $currentZoneId]);

        return $res->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}