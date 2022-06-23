<?php

declare(strict_types=1);

namespace Galerie;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'galerie' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/galerie[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GalerieController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            0 => __DIR__ . '/../view',
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\GalerieController ::class => InvokableFactory::class,
        ],
    ],
];