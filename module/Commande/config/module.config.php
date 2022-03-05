<?php

declare(strict_types=1);

namespace Commande;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;


/**
 *
 * This file has been generated with LaminasGen
 * https://github.com/ThomasLeconte/laminas-gen
 *
 */
return [
  'router' => [
    'routes' => [
      'commande' => [
        'type'  => Segment::class,
        'options' => [
          'route' => '/commande[:action[/:id]]',
          'constraints' => [
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ],
          'defaults' => [
            'controller'  =>  Controller\CommandeController::class,
            'action' => 'index',
          ],
        ],
      ],
    ],
  ],
  'view_manager' => [
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => [
      'layout/layout'  =>  __DIR__.'/../view/layout/layout.phtml',
      'application/index/index'  =>  __DIR__.'/../view/application/index/index.phtml',
      'error/404'  =>  __DIR__.'/../view/error/404.phtml',
      'error/index'  =>  __DIR__.'/../view/error/index.phtml',
    ],
    'template_path_stack' => [
      0  =>  __DIR__.'/../view',
    ],
  ],
  'controllers' => [
    'factories' => [
      Controller\CommandeController ::class => InvokableFactory::class,
    ],
  ],
];