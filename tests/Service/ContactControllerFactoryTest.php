<?php

namespace Org_Heigl\ContactTest\Service;

use Org_Heigl\Contact\Service\ContactControllerFactory;
use Zend\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;

/**
 * test case.
 */
class ContactControllerFactoryTest extends TestCase
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

    public function testCreationOfContactControllerViaFactory()
    {
        $this->markTestSkipped('Some More testing has to be done here');
        $contactForm = $this->getMock('\OrgHeiglContact\Form\ContactForm');
        $transport   = $this->getMock('\Zend\Mail\Transport\TransportInterface');
        $message     = $this->getMock('\Zend\Mail\Message');
        $serviceLocator = new ServiceManager();
        $serviceLocator->setFactory('message', '\OrgHeiglContact\Services\MailMessageFactory', false);
        $serviceLocator->setFactory('transport', '\OrgHeiglContact\Services\MailTransportFactory', false);
        $serviceLocator->setInvokableClass('OrgHeiglContact\Form\ContactForm', 'OrgHeiglContact\Form\ContactForm', false);
        $serviceManager = new ServiceLocator();
        $factory = new  ContactControllerFactory();
        $controller = $factory->createService($serviceLocator);
        $this->assertInstanceOf('\OrgHeiglContact\Controller\ContactController', $controller);        
        $this->assertAttributeInstanceOf('\Zend\Mail\Transport\TransportInterface', 'transport', $controller);  
        $this->assertAttributeEquals($transport, 'transport', $controller);      
        $this->assertAttributeInstanceOf('\Zend\Mail\Message', 'message', $controller);  
        $this->assertAttributeEquals($message, 'message', $controller);      
        $this->assertAttributeInstanceOf('\OrgHeiglContact\Form\ContactForm', 'form', $controller);        
        $this->assertAttributeEquals($contactForm, 'form', $controller);      
    }
}

