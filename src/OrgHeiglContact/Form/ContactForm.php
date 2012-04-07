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
namespace OrgHeiglContact\Form;

use Zend\Form\Form,
    Zend\Validator\Hostname as HostnameValidator,
    OrgHeiglContact\Validator\IsEmpty as EmptyValidator
;

/**
 * The Contact-Form
 *
 * @category  Contact-Form
 * @package   OrgHeiglContact
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/OrgHeiglContact
 */
class ContactForm extends Form
{
    /**
     * Initialize the form
     *
     * @return ContactForm
     */
    public function init()
    {
        $this->setName('contact');

        $this->addElement('text', 'from', array(
                'label'     => 'From:',
                'required'  => true,
                'validators' => array(
        array('EmailAddress', true, array(
                        'allow'  => HostnameValidator::ALLOW_DNS,
                        'domain' => true,
        )),
        ),
        ));

        $this->addElement('text', 'subject', array(
                'label'      => 'Subject:',
                'required'   => true,
                'filters'    => array(
                    'StripTags',
        ),
                'validators' => array(
        array('StringLength', true, array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 140,
        )),
        ),
        ));

        $this->addElement('textarea', 'body', array(
                'label'    => 'Your message:',
                'required' => true,
                'cols'     => 80,
                'rows'     => 10,
        ));

        $this->addElement('text', 'country', array(
                'required'       => false,
                'validators'     => array(array('Identical',true,array('token'=> ''))),
                'value'          => '',
                'ignore'         => true,
                'class'          => 'zonkos',
                'label'          => 'SPAM-Protection: Please leave this field as it is!'
        ));

        $this->addElement('hash', 'csrf', array(
                'ignore'   => true,
                'required' => true,
        ));

        $this->addElement('submit', 'Send', array(
                'label'    => 'Send',
                'required' => false,
                'ignore'   => true,
        ));
    }
}