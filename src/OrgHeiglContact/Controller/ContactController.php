<?php
/**
 * Copyright (c) 2011-2012 Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  ContactForm
 * @package   HeiglContact
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/php.ug
 */
namespace OrgHeiglContact\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mail\Transport\TransportInterface;
use OrgHeiglContact\Form\ContactForm;
use Zend\Mail\Message as Message;
use Zend\View\Model\ViewModel;

/**
 * The Contact-Form Controller
 *
 * @category  ContactForm
 * @package   OrgHeiglContact
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/OrgHeiglContact
 */
class ContactController extends AbstractActionController
{
    /**
     * THe storage of the form-object
     *
     * @var ContactForm $form
     */
    protected $form;

    /**
     * Storage of the message
     *
     * @var Message $message
     */
    protected $message = null;

    /**
     * Storage of the default transport
     *
     * @var Transport $transport
     */
    protected $transport = null;

    /**
     * Create the Controller-Instance
     * 
     * @param ContactForm $form
     */
    public function __construct(ContactForm $form = null)
    {
        if (null !== $form) {
             $this->setContactForm($form);
        }
    }

    /**
     * Set the default message
     *
     * @param Message $message the message to set as default
     *
     * @return ContactController
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Set the default transport
     *
     * @param Transport $transport The transport to set as default
     *
     * @return ContactController
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * Set the given form as contact-form
     *
     * @param ContactForm $form
     *
     * @return ContactController
     */
    public function setContactForm(ContactForm $contactForm)
    {
        $this->form = $contactForm;
        $this->form->init();
        return $this;
    }

    /**
     * Display a contact-form
     *
     * @return void
     */
    public function indexAction()
    {
        return array('form' => $this->form);
    }

    /**
     * Process the form
     *
     * @return void
     */
    public function processAction()
    {
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('contact');
        }
        $post = $this->request->getPost();
        $form = $this->form;
        $form->setData($post);
        if (!$form->isValid()) {
            $view = new ViewModel(array(
                        'error' => true,
                        'form'  => $form
            ));
            $view->setTemplate('org-heigl-contact/contact/index');
            return $view;
        }

        // send email...
        $this->sendEmail($form->getData());

        return $this->redirect()->toRoute('contact/thank-you');
    }

    /**
     * Send the email
     *
     * @param array $params The parameters to include in the email
     *
     * @return boolean
     */
    protected function sendEmail($values)
    {
        $from    = $values['from'];
        $subject = '[Contact Form] ' . $values['subject'];
        $body    = $values['body'];

        $this->message->addFrom($from)
                      ->addReplyTo($from)
                      ->setSubject($subject)
                      ->setBody($body);
        $this->transport->send($this->message);
    }

    /**
     * Display a thank-you message
     *
     * @return void
     */
    public function thankYouAction()
    {
        $headers = $this->request->getHeaders();
        if (!$headers->has('Referer')
            || !preg_match('#/contact$#',
        $headers->get('Referer')->getFieldValue())
        ) {
            return $this->redirect()->toRoute('contact');
        }

        return array();

    }
}
