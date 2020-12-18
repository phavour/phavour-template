<?php /** @noinspection PhpUnused */

/**
 * Phavour PHP Framework Library
 *
 * @author      Phavour Project
 * @copyright   2013-2014 Phavour Project
 * @link        http://phavour-project.com
 * @license     http://phavour-project.com/license
 * @since       1.0.0
 * @package     Phavour
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Phavour\PhavourTemplate\AuthenticationPackage\Src;

use Phavour\Auth;
use Phavour\Runnable;
use Phavour\Session\Storage;

/**
 * Class Authentication
 * @package Phavour\PhavourTemplate\AuthenticationPackage\Src
 */
class Authentication extends Runnable
{
    /**
     * @var Auth|null
     */
    private $auth = null;

    public function init()
    {
        $this->auth = Auth::getInstance();
    }

    public function index()
    {
        if ($this->auth->isLoggedIn()) {
            $this->redirect(
                $this->urlFor('Authentication.loggedin')
            );
            return;
        }

        $this->redirect(
            $this->urlFor('Authentication.login')
        );
        return;
    }

    /** @noinspection PhpUnused */
    public function login()
    {
        if ($this->auth->isLoggedIn()) {
            $this->redirect(
                $this->urlFor('Authentication.loggedin')
            );
            return;
        }
        $storage = new Storage('authErrors');

        if ($this->request->isPost()) {
            $email = $this->request->getParam('email', null);
            $password = $this->request->getParam('password', null);
            if ($this->processLogin($email, $password) === true) {
                $this->redirect(
                    $this->urlFor('Authentication.loggedin')
                );
                return;
            }
            $storage->set('invalid', true);
            $this->redirect(
                $this->urlFor('Authentication.login')
            );
            return;
        }

        $this->view->set(
            'authError',
            $storage->get('invalid')
        );
        $storage->remove('invalid');
    }

    /** @noinspection PhpUnused */
    public function loggedin()
    {
        if (!$this->auth->isLoggedIn()) {
            $this->redirect(
                $this->urlFor('Authentication.login')
            );
            return;
        }

        $identity = $this->auth->getIdentity();
        $this->view->set('name', $identity['name']);
        $this->view->set('email', $identity['email']);
    }

    public function logout()
    {
        $this->auth->logout();
        $this->redirect(
            $this->urlFor('Authentication.login')
        );
        return;
    }

    private function processLogin($email, $password)
    {
        if ($email === 'test@example.com' && $password === 'password') {
            $this->auth->login(
                array(
                    'email' => 'test@example.com',
                    'name' => 'Joe'
                )
            );
            $this->auth->addRole('user');

            return true;
        }

        return false;
    }
}