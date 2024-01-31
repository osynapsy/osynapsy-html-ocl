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

use Osynapsy\Html\Tag as Tag;
use Osynapsy\Html\Component;

class ComboBox extends Component
{
    public $isTree = false;
    public $placeholder = ['', '- Seleziona -'];
    protected $defaultValue;
    protected $requestValue;

    public function __construct($name)
    {
        parent::__construct('select', $name);
        $this->attribute('name', $name);
    }

    protected function __build_extra__()
    {
        $this->requestValue = $this->getGlobal($this->name, $_REQUEST);
        if (empty($this->requestValue) && $this->requestValue !== '0') {
            $this->requestValue = $this->defaultValue;
        }
        if (!empty($this->placeholder) && !$this->getParameter('option-select-disable') && is_array($this->data)){
            array_unshift($this->data, $this->placeholder);
        }
        $this->optionsFactory();
    }

    protected function optionsFactory()
    {
        foreach ($this->data as $item) {
            $item = array_values(!is_array($item) ? [trim($item)] : $item);
            $value = $item[0];
            $label = isset($item[1]) ? $item[1] : $item[0];
            $disabled = empty($item[2]) ? false : true;
            $this->optionFactory($value, $label, $disabled);
        }
    }

    protected function optionFactory($value, $label, $disabled = 0)
    {
        $option = (new Tag('option'))->attribute('value', $value);
        $option->add($this->nvl($label, $value));
        if ($disabled) {
            $this->attribute('disabled','disabled');
        }
        if ($this->requestValue == $value) {
            $option->attribute('selected', 'selected');
        }
        if (empty($this->getAttribute('readonly')) || !empty($option->getAttribute('selected'))) {
            $this->add($option);
        }
        return $option;
    }

    public function countOption()
    {
        return count($this->data);
    }

    public function setAction($action, $parameters = null, $class = 'change-execute', $confirmMessage = null)
    {
        return parent::setAction($action, $parameters, $class, $confirmMessage);
    }

    public function setDefaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function setPlaceholder($label, $value = '')
    {
        $this->placeholder = $label === false ? [] : [$value, $label, null];
        return $this;
    }
}
