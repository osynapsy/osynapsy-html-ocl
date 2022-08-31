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

class RadioBox extends Component
{
    protected $label;
    protected $radio;

    public function __construct($id, $label, $value = null)
    {
        parent::__construct('span', $id.'_box');
        $this->label = $label;
        $this->radio = $this->radioFactory($id, $value);
    }

    protected function radioFactory($id, $value)
    {
        $radio = new Tag('input', $id);
        $radio->att([
            'type' => 'radio',
            'name' => $id,
            'value' => $value
        ]);
        return $radio;
    }

    public function __build_extra__()
    {
        if ($this->isChecked()) {
            $this->getRadio()->att('checked','checked');
        }
        $this->add($this->getRadio());
        if (!empty($this->label)) {
            $this->add(' '.$this->label);
        }
    }

    public function isChecked()
    {
        $radioName = $this->getRadio()->name;
        $radioValue = $this->getRadio()->value;
        if (strpos($radioName, '[') === false) {
            return array_key_exists($radioName, $_REQUEST) && $_REQUEST[$radioName] == $radioValue ? true : false;
        }
        list($name,) = explode('[',$radioName);
        return is_array($_REQUEST[$name]) && in_array($radioValue, $_REQUEST[$name]) ? true : false;
    }

    public function getRadio()
    {
        return $this->radio;
    }

    public function setDisabled($condition)
    {
        if ($condition) {
            $this->getRadio()->att('disabled', 'disabled');
        }
    }
}
