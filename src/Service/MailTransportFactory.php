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
 * @package   HeiglContact
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/php.ug
 */

namespace Org_Heigl\Contact\Service;

use Interop\Container\ContainerInterface;
use Traversable;
use Zend\Mail\Transport;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\ArrayUtils;

/**
 * The Contact-Controller Factory
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/OrgHeiglContact
 */
class MailTransportFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config  = $container->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $config  = $config['OrgHeiglContact']['mail_transport'];
        $class   = $config['class'];
        $options = $config['options'];

        switch ($class) {
            case 'Zend\Mail\Transport\Sendmail':
            case 'Sendmail':
            case 'sendmail';
                $transport = new Transport\Sendmail();
                break;
            case 'Zend\Mail\Transport\Smtp';
            case 'Smtp';
            case 'smtp';
                $options = new Transport\SmtpOptions($options);
                $transport = new Transport\Smtp($options);
                break;
            case 'Zend\Mail\Transport\File';
            case 'File';
            case 'file';
                $options = new Transport\FileOptions($options);
                $transport = new Transport\File($options);
                break;
            default:
                throw new \DomainException(sprintf(
                    'Unknown mail transport type provided ("%s")',
                    $class
                ));
        }

        return $transport;
    }
}