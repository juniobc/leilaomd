<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\HomeController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'contato' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/contato',
                    'defaults' => [
                        'controller' => Controller\ContatoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'leilao' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/leilao[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\LeilaoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'blog' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/blog[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'servico' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/servicos[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\ServicoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'empresa' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/empresa',
                    'defaults' => [
                        'controller' => Controller\EmpresaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'portal' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/portal',
                    'defaults' => [
                        'controller' => Controller\PortalController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'ouvidoria' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/ouvidoria',
                    'defaults' => [
                        'controller' => Controller\OuvidoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'colaborador' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/colaborador',
                    'defaults' => [
                        'controller' => Controller\ColaboradorController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'fale' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/fale',
                    'defaults' => [
                        'controller' => Controller\FaleController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'agenda' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/agenda',
                    'defaults' => [
                        'controller' => Controller\AgendaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'usuario' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/usuario',
                    'defaults' => [
                        'controller' => Controller\UsuarioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'funciona' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/funciona',
                    'defaults' => [
                        'controller' => Controller\FuncionaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\HomeController::class => InvokableFactory::class,
            Controller\ContatoController::class => InvokableFactory::class,
			Controller\LeilaoController::class => InvokableFactory::class,
			Controller\BlogController::class => InvokableFactory::class,
			Controller\ServicoController::class => InvokableFactory::class,
			Controller\EmpresaController::class => InvokableFactory::class,
			Controller\PortalController::class => InvokableFactory::class,
			Controller\OuvidoriaController::class => InvokableFactory::class,
			Controller\ColaboradorController::class => InvokableFactory::class,
			Controller\FaleController::class => InvokableFactory::class,
			Controller\AgendaController::class => InvokableFactory::class,
			Controller\UsuarioController::class => InvokableFactory::class,
			Controller\FuncionaController::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
