<?php

namespace OrgHeiglContact;

return array(
	'service_manager' => array(
		'factories' => array(
			'message'   => 'OrgHeiglContact\Service\MailMessageFactory',
			'transport' => 'OrgHeiglContact\Service\MailTransportFactory',
		),
		'instances' => array(
			'OrgHeiglContact\Form\ContactForm' => 'OrgHeiglContact\Form\ContactForm',
		),
	),
	'controllers' => array(
		'factories' => array(
			'OrgHeiglContact\Controller\ContactController' => 'OrgHeiglContact\Service\ContactControllerFactory'
		),
	),
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
	'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contact',
                    'defaults' => array(
                        'controller' => 'OrgHeiglContact\Controller\ContactController',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process',
                            'defaults' => array(
                                'action'     => 'process',
                            ),
                        ),
                    ),
                    'thank-you' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/thank-you',
                            'defaults' => array(
                                'action'     => 'thank-you',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    )
);
