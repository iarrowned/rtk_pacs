<?php

namespace Model;

use Helper\DB;
use PDO;

class Action
{
    public static function getActionById(int $id): array
    {
        $query = "SELECT * FROM actions WHERE id = ?";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute([$id]);

        return $res->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public static function makeAction(int $userId, int $zoneId)
    {
        $query = "INSERT INTO action (user_id, zone_id) VALUES (:user_id, :zone_id)";
    }
}