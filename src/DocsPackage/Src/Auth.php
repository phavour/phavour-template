<?php
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
namespace Phavour\PhavourTemplate\DocsPackage\Src;

use Phavour\Runnable;

class Auth extends Runnable
{
    public function init()
    {
        $this->view->setLayout('default.phtml');
    }

    public function authDocs()
    {
        $baseDir = realpath(__DIR__ . '/../../AuthenticationPackage');
        $files = scandir($baseDir);
        $all = [];
        $pos = strpos($baseDir, 'src/AuthenticationPackage/');
        if ($pos !== false) {
            var_dump($pos);exit;
        }
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $all[] = $file;
            if (is_dir($baseDir . '/' . $file)) {
                $tmpFiles = $this->getFilesInFolder($baseDir . '/' . $file);
                foreach ($tmpFiles as $tmpFile) {
                    $all[] = ltrim(explode('AuthenticationPackage', $tmpFile)[1], '/');
                }
            }
        }
        $this->view->files = $all;

        $passedFile = $this->getRequest()->getParam('file');
        if ($passedFile !== null) {
            if (!in_array($passedFile, $all)) {
                return $this->redirect($this->urlFor('docs.auth'));
            }
            $fileContents = file($baseDir . '/' . $passedFile);
            if ($fileContents === false) {
                return $this->redirect($this->urlFor('docs.auth'));
            }
            $this->view->fileLines = $fileContents;
            $this->view->fileName = $passedFile;
        }
    }

    protected function getFilesInFolder($folder)
    {
        $files = scandir($folder);
        $all = [];
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $all[] = $folder . '/' . $file;
            if (is_dir($folder . '/' . $file)) {
                $others = $this->getFilesInFolder($folder . '/' . $file);
                foreach ($others as $other) {
                    $all[] = $other;
                }
            }
        }
        return $all;
    }
}