<?php
return array(
    'di' => array(
        'definition' => array('class' => array(
            'Zend\Mail\Message' => array(
                'addTo' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
                'addFrom' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
                'setSender' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
            ),
        )),
        'instance' => array(
            'OrgHeiglContact\Controller\ContactController' => array('parameters' => array(
                'contactForm'      => 'OrgHeiglContact\Form\ContactForm',
            )),
            'Zend\View\Resolver\TemplateMapResolver' => array('parameters' => array(
                'map'  => array(
                    'contact/index'     => __DIR__ . '/../view/contact/index.phtml',
                    'contact/thank-you' => __DIR__ . '/../view/contact/thank-you.phtml',
                ),
            )),
            'Zend\View\Resolver\TemplatePathStack' => array('parameters' => array(
                'paths'  => array(
                    'contact' => __DIR__ . '/../view',
                ),
            )),
            'Zend\Mvc\Router\RouteStack' => array('parameters' => array(
                'routes' => array(
                    'contact' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/m/contact',
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
            )),
        ),
    )
);
