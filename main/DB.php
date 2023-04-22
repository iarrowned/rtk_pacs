<?php

namespace Helper;

use PDO;

class DB
{
    public PDO $connection;
    private static $_instance = null;
    private const DB_NAME = 'kirill';
    private const DB_USER = 'kirill';
    private const DB_PASSWORD = 'Amfetamin32+';
    private const DB_HOST = 'localhost';

    private function __construct()
    {
        $this->connection = new \PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME,
            self::DB_USER,
            self::DB_PASSWORD);
    }

    public static function getInstance(): ?DB
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}