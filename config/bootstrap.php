<?php
require "vendor/autoload.php";

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;



$isDevMode = true;

$config = ORMSetup::createAnnotationMetadataConfiguration(['src/Main'], $isDevMode);

$connection = [
    'dbname' => 'test_loc',
    'user' => 'kirill',
    'password' => 'Amfetamin32+',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$entityManager = EntityManager::create($connection, $config);