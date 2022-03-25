<?php

require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$entitiesPath = [
    "module/Application/src/Model",
    "module/Photo/src/Model",
    "module/Galerie/src/Model",
    "module/Commande/src/Model"
];

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$dbConfig = (require_once "config/autoload/global.php")["db"];

// Connexion à la base de données
$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => explode("=", explode(";", $dbConfig["dsn"])[1])[1],
    'charset' => 'utf8',
    'user' => $dbConfig["username"],
    'password' => $dbConfig["password"],
    'dbname' => explode("=", explode(";", explode(":", $dbConfig["dsn"])[1])[0])[1],
];

$config = Setup::createAnnotationMetadataConfiguration(
    $entitiesPath,
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);
return EntityManager::create($dbParams, $config);