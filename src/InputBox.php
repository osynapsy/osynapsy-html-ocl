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

use Osynapsy\Html\Component as Component;

class InputBox extends Component
{
    public function __construct($type, $name, $id = null)
    {
        parent::__construct('input', $id);
        $this->att('type', $type)
             ->att('name', $name);
    }

    protected function __build_extra__()
    {
        $value = $this->getGlobal($this->name, $_REQUEST);
        $this->att('value', (empty($value) && $value != '0' ? $this->defaultValue : $value));
    }

    public function setValue($value)
    {
        if (array_key_exists($this->name, $_REQUEST)) {
            return $this;
        }
        if (substr_count($this->name, '[')) {
            return $this->setValueArrayInRequest($value);
        }
        $_REQUEST[$this->name] = $value;
        return $this;
    }

    private function setValueArrayInRequest($value)
    {
        $arrName = explode('[', str_replace(']','',$this->name));
        $request =& $_REQUEST;
        $insert  = false;
        foreach ($arrName as $part) {
            if (!array_key_exists($part, $request)) {
                $request[$part] = [];
                $insert = true;
            }
            $request =& $request[$part];
        }
        if ($insert) {
            $request = $value;
        }
        return $this;
    }
}
