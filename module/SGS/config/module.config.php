<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SGS;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Authentication\AuthenticationService;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
			'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/login',
                    'defaults' => [
                        'controller' => Controller\AutenticaController::class,
                        'action'     => 'login',
                    ],
                ],
            ],		
			'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/logout',
                    'defaults' => [
                        'controller' => Controller\AutenticaController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],	
			'criarAdmin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/criar-admin',
                    'defaults' => [
                        'controller' => Controller\AutenticaController::class,
                        'action'     => 'criarAdmin',
                    ],
                ],
            ],		
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'grupo' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/admin/grupo/:action',
					'defaults' => [
                        'controller' => Controller\GrupoController::class
                    ],
                ],
            ],
			'loja' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/admin/loja/:action',
					'defaults' => [
                        'controller' => Controller\LojaController::class
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
			Controller\GrupoController::class => Controller\Factory\GrupoControllerFactory::class,
			Controller\LojaController::class => Controller\Factory\LojaControllerFactory::class,
			Controller\AutenticaController::class => Controller\Factory\AutenticaControllerFactory::class,
        ],
    ],
	'service_manager' => [
        'factories' => [
			AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\GerenciaUsuario::class => Service\Factory\GerenciaUsuarioFactory::class,
            Service\GerenciaGrupo::class => Service\Factory\GerenciaGrupoFactory::class,
            Service\GerenciaLoja::class => Service\Factory\GerenciaLojaFactory::class,
            Service\Autenticador::class => Service\Factory\AutenticadorFactory::class,
            Service\GerenciaAutenticador::class => Service\Factory\GerenciaAutenticadorFactory::class,
        ],
    ],
	'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => InvokableFactory::class,                    
        ],
       'aliases' => [
            'adminMenu' => View\Helper\Menu::class
       ]
    ],
    'view_manager' => [
		//'exception_template'       => 'error/index',
		'template_map' => [
            'layout/sgsLayout'           => __DIR__ . '/../view/layout/sgsLayout.phtml',
            'layout/sgsLoginLayout'           => __DIR__ . '/../view/layout/sgsLoginLayout.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
		'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
	
	'access_filter' => [
        'controllers' => [
            Controller\GrupoController::class => [
                ['actions' => ['criar'], 'allow' => '@']
            ],
			Controller\IndexController::class => [
                ['actions' => ['index'], 'allow' => '@']
            ],
        ]
    ],
	
	'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
