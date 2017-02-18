# Org_Heigl\Contact

[![Build-Status](https://secure.travis-ci.org/heiglandreas/OrgHeiglContact.png?branch=master)](https://travis-ci.org/heiglandreas/OrgHeiglContact)
[![Coverage Status](https://coveralls.io/repos/github/heiglandreas/OrgHeiglContact/badge.svg?branch=master)](https://coveralls.io/github/heiglandreas/OrgHeiglContact?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglContact/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglContact/?branch=master)
[![Code Climate](https://lima.codeclimate.com/github/heiglandreas/OrgHeiglContact/badges/gpa.svg)](https://lima.codeclimate.com/github/heiglandreas/OrgHeiglContact)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8f17c61b46264450bd283649c8e4341e)](https://www.codacy.com/app/github_70/OrgHeiglContact?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=heiglandreas/OrgHeiglContact&amp;utm_campaign=Badge_Grade)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a9935726-d41a-400c-ba0b-0e9feb2a4fb7/mini.png)](https://insight.sensiolabs.com/projects/a9935726-d41a-400c-ba0b-0e9feb2a4fb7)

[![Latest Stable Version](https://poser.pugx.org/org_heigl/contact/v/stable)](https://packagist.org/packages/org_heigl/contact)
[![Total Downloads](https://poser.pugx.org/org_heigl/contact/downloads)](https://packagist.org/packages/org_heigl/contact)
[![License](https://poser.pugx.org/org_heigl/contact/license)](https://packagist.org/packages/org_heigl/contact)
[![composer.lock](https://poser.pugx.org/org_heigl/contact/composerlock)](https://packagist.org/packages/org_heigl/contact)

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


