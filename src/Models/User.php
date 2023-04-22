<?php

namespace Model;

use Helper\DB;
use PDO;

class User
{
    public static function getUserById(int $id): array
    {
        $query = "SELECT * FROM user WHERE id = ?";
        $res = DB::getInstance()->connection->prepare($query);
        $res->execute([$id]);

        return $res->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}