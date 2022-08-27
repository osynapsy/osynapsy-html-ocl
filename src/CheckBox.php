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
use Osynapsy\Html\Tag;

class CheckBox extends Component
{
    private $checkbox = null;

    public function __construct($name, $tag = 'span', $value = '1')
    {
        parent::__construct($tag, $name);
        $this->add($this->hiddenFieldFactory($name));
        $this->checkbox = $this->add($this->checkboxFactory($name, $value));
    }

    protected function hiddenFieldFactory($name)
    {
        return sprintf('<input type="hidden" name="%name" value="0">', $name);
    }


    protected function checkboxFactory($name, $value)
    {
        $checkbox = new Tag('input', $name, 'osy-check');
        $checkbox->att([
            'type' => 'checkbox',
            'name' => $name,
            'value' => $value
        ]);
    }

    protected function __build_extra__()
    {
        if (!empty($_REQUEST[$this->id])) {
            $this->getCheckbox()->att('checked','checked');
        }
    }

    public function getCheckbox()
    {
        return $this->checkbox;
    }

    public function setDisabled($condition): \this
    {
        if ($condition) {
            $this->getCheckbox()->att('disabled', 'disabled');
        }
        return $this;
    }
}
