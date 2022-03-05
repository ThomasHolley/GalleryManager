<?php

namespace Photo;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * With this function you define factory to return your futures database mapped objects
     * 
     * Error : "Unable to resolve service "Photo\AdapterInterface" -> Import AdapterInterface
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
//                Model\AlbumTable::class => function($container) {
//                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
//                    return new Model\AlbumTable($tableGateway);
//                },
//                Model\AlbumTableGateway::class => function ($container) {
//                    $dbAdapter = $container->get(AdapterInterface::class);
//                    $resultSetPrototype = new ResultSet();
//                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
//                    return new TableGateway('photo', $dbAdapter, null, $resultSetPrototype);
//                },
            ],
        ];
    }

    /**
     * Define factory for PhotoController with AlbumTable parameter
     * 
     * Error: "Unable to resolve service "Photo\Controller\PhotoController" to a factory" -> Remove controllers factories at start of your Photo/config/module.config.php
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
//                Controller\PhotoController::class => function($container) {
//                    return new Controller\PhotoController(
//                        $container->get(Model\AlbumTable::class)
//                    );
//                },
            ],
        ];
    }
}