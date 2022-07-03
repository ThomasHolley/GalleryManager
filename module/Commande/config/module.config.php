<?php

declare(strict_types=1);

namespace Commande;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'commande' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/commande[:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CommandeController::class,
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
            Controller\CommandeController ::class => InvokableFactory::class,
        ],
    ],
];