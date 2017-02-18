<?php

namespace Org_Heigl\Contact;

use Org_Heigl\Contact\Controller\ContactController;
use Org_Heigl\Contact\Form\ContactForm;
use Org_Heigl\Contact\Service\ContactControllerFactory;
use Org_Heigl\Contact\Service\MailMessageFactory;
use Org_Heigl\Contact\Service\MailTransportFactory;

return [
	'service_manager' => [
		'factories' => [
			'message'   => MailMessageFactory::class,
			'transport' => MailTransportFactory::class,
		],
		'invokables' => [
			ContactForm::class => ContactForm::class,
		],
	],
	'controllers' => [
		'factories' => [
			ContactController::class => ContactControllerFactory::class,
		],
	],
	'view_manager' => array(
			'display_not_found_reason' => true,
			'display_exceptions'       => true,
			'doctype'                  => 'HTML5',
			'not_found_template'       => 'error/404',
			'exception_template'       => 'error/index',
			'template_map'             => array(),
			'template_path_stack' => array(
					__DIR__ . '/../view',
			),
	),	
	'router' => [
        'routes' => [
            'contact' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/contact',
                    'defaults' => [
                        'controller' => ContactController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'process' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/process',
                            'defaults' => [
                                'action'     => 'process',
                            ],
                        ],
                    ],
                    'thank-you' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/thank-you',
                            'defaults' => [
                                'action'     => 'thank-you',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
