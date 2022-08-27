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

use Osynapsy\Html\Component;

class TextArea extends Component
{
    public function __construct($name)
    {
        parent::__construct('textarea',$name);
        $this->name = $name;
    }

    public function __build_extra__()
    {
        if (!empty($_REQUEST[$this->id])) {
            $this->add($_REQUEST[$this->id]);
        } elseif (!empty($this->defaultValue) || $this->defaultValue == '0') {
            $this->add($this->defaultValue);
        }
    }

    public function setAction($action, $parameters = null, $class = 'change-execute', $confirmMessage = null)
    {
        return parent::setAction($action, $parameters, $class, $confirmMessage);
    }
}
