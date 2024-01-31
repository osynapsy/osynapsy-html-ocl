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

use Osynapsy\Html\Tag;
use Osynapsy\Html\Component;

class CheckList extends Component
{
    private $parents = [];

    public function __construct($name)
    {
        parent::__construct('div', $name);
        $this->setClass('ocl-checklist');
    }

    protected function __build_extra__()
    {
        $requestValues = $_REQUEST[$this->id] ?? [];
        foreach ($this->data as $value) {
            $value[2] = in_array($value[0], $requestValues) ? true : false;
            $this->rowFactory($value);
        }
    }

    protected function rowFactory($value, $level = 0)
    {

        $tr = $this->add(new Tag('div', null, 'ocl-checklist-row'));
        $tr->add(str_repeat('&nbsp;', $level * 7));
        $tr->add($this->checkBoxFactory($value));
        if (!empty($this->parents[$value[0]])) {
            foreach($this->parents[$value[0]] as $value) {
               $tr->add($this->rowFactory($value, $level + 1));
            }
        }
        return $tr;
    }

    protected function checkBoxFactory($value)
    {
        $CheckBox = new CheckBox(sprintf('%s[]', $this->id), 'span', $value[0], $value[1]);
        if (!empty($value[2])) {
           $CheckBox->getCheckbox()->attribute('checked', 'checked');
        }
        return $CheckBox;
    }

    public function setData($data)
    {
        if (empty($data) || !is_array($data)) {
            return;
        }
        foreach($data as $rec) {
            if (empty($rec['parent'])) {
                $this->data[] = array_slice(array_values($rec), 0 ,2);
            } else {
                $this->parents[$rec['parent']][] = $rec;
            }
        }
    }

    public function setHeight($px)
    {
        $this->style = 'height: '.$px.'px; border: 1px solid black; overflow: auto;';
    }
}
