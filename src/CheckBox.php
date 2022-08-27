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

    public function __construct($id, $tag = 'span', $value = '1')
    {
        parent::__construct($tag, sprintf('%s_container', $id));
        $this->checkbox = $this->checkboxFactory($id, $value);
    }

    protected function checkboxFactory($id, $value)
    {
        $checkbox = new Tag('input', $id);
        $checkbox->att(['type' => 'checkbox', 'name' => $id, 'value' => $value]);
        return $checkbox;
    }

    protected function __build_extra__()
    {
        $checkBoxId = $this->getCheckbox()->getAttribute('id');
        if (!empty($_REQUEST[$checkBoxId])) {
            $this->getCheckbox()->att('checked','checked');
        }
        $this->add($this->hiddenFieldFactory($checkBoxId));
        $this->add((string) $this->getCheckbox());
    }

    protected function hiddenFieldFactory($name)
    {
        return sprintf('<input type="hidden" name="%s" value="0">', $name);
    }

    public function getCheckbox()
    {
        return $this->checkbox;
    }

    public function setDisabled($condition)
    {
        if ($condition) {
            $this->getCheckbox()->att('disabled', 'disabled');
        }
        return $this;
    }
}
