<?php

use \PHPUnit_Framework_TestCase;
use \OrgHeiglContact\Form\ContactForm;

/**
 * ContactForm test case.
 */
class ContactFormTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var ContactForm
	 */
	private $ContactForm;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated ContactFormTest::setUp()
		
		$this->ContactForm = new ContactForm(/* parameters */);
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ContactFormTest::tearDown()
		$this->ContactForm = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Test Validation of FormFields
	 * 
	 */
	public function testFormValidation()
	{
		$this->assertInstanceof('OrgHeiglContact\Form\ContactForm', $this->ContactForm);
		
		$from = $this->ContactForm->get('from')->getValidatorChain()->getValidators();
		
		$this->assertEquals(array('Zend\Validator\EmailAddress'), $from);
	}
}

