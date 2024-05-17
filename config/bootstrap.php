<?php
require "vendor/autoload.php";

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load('/var/www/html/.env');

$isDevMode = true;

$config = ORMSetup::createAnnotationMetadataConfiguration(['src/Entity'], $isDevMode);

$connection = [
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_mysql',
];

$entityManager = EntityManager::create($connection, $config);