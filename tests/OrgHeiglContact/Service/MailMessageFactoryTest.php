<?php

namespace OrgHeiglContact\Service;

use Zend\Di\ServiceLocator;

use \Zend\Mail\Message;
use \PHPUnit_Framework_TestCase;

/**
 * test case.
 */
class MailMessageFactoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated ContactControllerFactoryTest::setUp()
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated ContactControllerFactoryTest::tearDown()
        parent::tearDown();
    }

    public function testCreationOfMailMessageViaFactory()
    {
        $this->markTestSkipped('Some More testing has to be done here');
        $mailconfig = array(
            'OrgHeiglContact' => array(
                'message' => array(
                    'from' => 'test@example.com',
                )
            )
        );
        $serviceLocator = new ServiceLocator();
        $serviceLocator->set('config', array());
        $factory = new  MailMessageFactory();
        $message = $factory->createService($serviceLocator);
        $this->assertInstanceOf('\Zend\Mail\message', $message);        
        $this->assertEquals($mailconfig['from'], $message->getFrom());  
        $this->assertAttributeEquals($transport, 'transport', $controller);      
        $this->assertAttributeInstanceOf('\Zend\Mail\Message', 'message', $controller);  
        $this->assertAttributeEquals($message, 'message', $controller);      
        $this->assertAttributeInstanceOf('\OrgHeiglContact\Form\ContactForm', 'form', $controller);        
        $this->assertAttributeEquals($contactForm, 'form', $controller);      
    }
}

