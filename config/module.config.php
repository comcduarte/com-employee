<?php 

use Employee\Controller\DepartmentController;
use Employee\Controller\EmployeeConfigController;
use Employee\Controller\EmployeeController;
use Employee\Controller\Factory\DepartmentControllerFactory;
use Employee\Controller\Factory\EmployeeConfigControllerFactory;
use Employee\Controller\Factory\EmployeeControllerFactory;
use Employee\Form\DepartmentForm;
use Employee\Form\EmployeeForm;
use Employee\Form\Factory\DepartmentFormFactory;
use Employee\Form\Factory\EmployeeFormFactory;
use Employee\Service\Factory\EmployeeModelAdapterFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'department' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/department',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => DepartmentController::class,
                    ]
                ],
                'may_terminate' => FALSE,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => DepartmentController::class,
                            ],
                        ],
                    ],
                ],
            ],
            'employee' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/employee',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => EmployeeController::class,
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'config' => [
                        'type' => Segment::class,
                        'priority' => 100,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => EmployeeConfigController::class,
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => EmployeeController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'EVERYONE' => [
            'employee/default' => ['index','create','update','delete','find'],
            'department/default' => ['index','create','update','delete'],
        ],
        'admin' => [
            'employee/config' => ['index','clear','create', 'reconciledirectories','importemployees'],
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            \User\Controller\Plugin\CurrentUser::class => \User\Controller\Plugin\Factory\CurrentUserFactory::class,
        ],
        'aliases' => [
            'currentUser' => \User\Controller\Plugin\CurrentUser::class,
        ],
        
    ],
    'controllers' => [
        'aliases' => [
            'department' => DepartmentController::class,
            'employee' => EmployeeController::class,
        ],
        'factories' => [
            DepartmentController::class => DepartmentControllerFactory::class,
            EmployeeController::class => EmployeeControllerFactory::class,
            EmployeeConfigController::class => EmployeeConfigControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            EmployeeForm::class => EmployeeFormFactory::class,
            DepartmentForm::class => DepartmentFormFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            'employee' => [
                'label' => 'Employee',
                'route' => 'employee/default',
                'class' => 'dropdown',
                'resource' => 'employee/default',
                'privilege' => 'index',
                'order' => 50,
                'pages' => [
                    [
                        'label' => 'Department Maintenance',
                        'route' => 'department/default',
                        'class' => 'dropdown-submenu',
                        'resource' => 'department/default',
                        'privilege' => 'index',
                        'pages' => [
                            [
                                'label' => 'Add Department',
                                'route' => 'department/default',
                                'action' => 'create',
                                'controller' => 'department',
                                'resource' => 'department/default',
                                'privilege' => 'create',
                            ],
                            
                            [
                                'label' => 'List Departments',
                                'route' => 'department/default',
                                'action' => 'index',
                                'controller' => 'department',
                                'resource' => 'department/default',
                                'privilege' => 'index',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Employee Maintenance',
                        'route' => 'employee/default',
                        'class' => 'dropdown-submenu',
                        'resource' => 'employee/default',
                        'privilege' => 'index',
                        'pages' => [
                            [
                                'label' => 'Add Employee',
                                'route' => 'employee/default',
                                'action' => 'create',
                                'resource' => 'employee/default',
                                'privilege' => 'create',
                            ],
                            [
                                'label' => 'List Employees',
                                'route' => 'employee/default',
                                'action' => 'index',
                                'resource' => 'employee/default',
                                'privilege' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'settings' => [
                'pages' => [
                    'employee' => [
                        'label' => 'Employee Settings',
                        'route' => 'employee/config',
                        'action' => 'index',
                        'resource' => 'employee/config',
                        'privilege' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
        ],
        'factories' => [
            'employee-model-adapter' => EmployeeModelAdapterFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'employee/config' => __DIR__ . '/../view/employee/config/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];