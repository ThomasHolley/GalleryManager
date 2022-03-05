<?php

namespace Photo;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'photo' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/photo[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PhotoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'photo' => __DIR__ . '/../view',
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\PhotoController ::class => InvokableFactory::class,
        ],
    ],
];