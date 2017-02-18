# Org_Heigl\Contact

[![Build-Status](https://secure.travis-ci.org/heiglandreas/OrgHeiglContact.png?branch=master)](https://travis-ci.org/heiglandreas/OrgHeiglContact)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglContact/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglContact/?branch=master)

This Modules provides a simple contact-form with spam-protection using a
honeypot. It is based on the [PhlyContact-Module](https://github.com/phly/PhlyContact) by Matthew WeierOPhinney.

The idea of the honeypot is based on a [blogpost by Lorna Jane Mitchell](https://lornajane.net/posts/2012/wordpress-contact-form-7-without-captcha)

The contact form is for example used at [php.ug]()https://php.ug/contact) and so far I 
haven't had spam from it in over 4 years. So the honeypot seems to be working. :)
 
## Installation

Install the package using [composer](https://getcomposer.org).

```bash
    composer require org_heigl/contact
```

## Usage

1. In your application.conf-file add the Module to the list of modules

```php
    return [
         'modules' => [
             'Org_Heigl\Contact',
         ]
    ]

```
2. Configure your settings by copying the file ```vendor/org_heigl/contact/config/module.org-heigl-contact.local.php.-dist```
to your applications ```autoload```-folder (removing the ```.dist``` on the way) and then altering the content.

```php
    return [
        'OrgHeiglContact' => [
            'mail_transport' => [
    //           'class'   => 'Zend\Mail\Transport\Smtp',
    //           'options' => [
    //               'host'             => 'localhost',
    //               'port'             => 587,
    //               'connectionClass'  => 'login',
    //               'connectionConfig' => [
    //                   'ssl'      => 'tls',
    //                   'username' => 'contact@your.tld',
    //                   'password' => 'password',
    //               ],
    //           ],
                 'class'  => 'File',
                 'options' => array(
                     'path' => sys_get_temp_dir(),
                 ],
            ],
            'message' => [
                 // These can be either a string, or an array of email => name pairs
                'to'     => 'contact@your.tld',
                'from'   => 'contact@your.tld',
                // This should be an array with minimally an "address" element, and
                // can also contain a "name" element
                'sender' => array(
                    'address' => 'contact@your.tld'
                ],
            ],
        ],
    ]
```

For the ```mail_transport```-settings you may want to have a look at 
[Zend\Mail](https://github.com/zendframework/zend-mail).

3. Link to the Form using ``$this->url('contact')`` in your view. This will render the form in your view.
4. There is no step four.


