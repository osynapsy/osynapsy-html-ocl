<?php
/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Ocl;

//costruttore del text box
class TextBox extends InputBox
{
    public function __construct($name, $id = null)
    {
        parent::__construct('text', $name, $id ?? $name);
    }

    public function onTyping($jsCode)
    {
        return $this->setClass('typing-execute')->attribute('ontyping', $jsCode);
    }

    public function onDblClick($jsCode)
    {
        return $this->attribute('ondblclick', $jsCode);
    }

    public function setAction($action, $parameters = null, $class = 'change-execute', $confirmMessage = null)
    {
        return parent::setAction($action, $parameters, $class, $confirmMessage);
    }
}