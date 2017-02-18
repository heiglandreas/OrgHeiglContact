<?php

namespace Org_Heigl\ContactTest\Form;

use PHPUnit\Framework\TestCase;
use Org_Heigl\Contact\Form\ContactForm;

/**
 * ContactForm test case.
 */
class ContactFormTest extends TestCase
{
	
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
		$this->ContactForm->init();
		
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
	 * test Validation of Form
	 * 
	 * @dataProvider provider
	 * @return void
	 */
    public function testFormValidation($res, $val)
    {
	    $val['csrf'] = $this->ContactForm->get('csrf')->getValue();
        $this->ContactForm->setData($val);
        $this->assertEquals($res, $this->ContactForm->isValid());
    }

	public function provider()
	{
		return array(
		        array(true, array(
					'from'=>'me@example.com',
					'subject' => 'my subject',
					'body' => 'My Message',
					'country' => '',
				)),
			    array(false, array(
					'from'=>'foo',
					'subject' => 'my subject',
					'body' => 'My Message',
					'country' => '',
				)),	
			array(false, array(
					'from'=>'me@example.com',
					'subject' => '',
					'body' => 'My Message',
					'country' => '',
				)),	
			array(false, array(
					'from'=>'me@example.com',
					'subject' => 'my subject',
					'body' => '',
					'country' => '',
				)),	
			array(false, array(
					'from'=>'me@example.com',
					'subject' => 'my subject',
					'body' => 'My message',
					'country' => 'foo',
				)),	
			array(false, array(
					'subject' => 'my subject',
					'body' => 'My message',
					'country' => 'foo',
				)),	
			array(false, array(
					'from'=>'me@example.com',
					'subject' => 'my subject',
					'body' => 'My message',
				)),	
		);//*/
	}
}

