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

//Costruttore del pannello html
class Panel extends Component
{
    private $tags = ['row' => 'tr', 'cell' => 'td'];
    private $rowClass = 'row';
    private $cellClass;

    public function __construct($id, $tag = 'table', $rowClass = null, $cellClass = null)
    {
        parent::__construct($tag, $id);
        if (!empty($rowClass)) {
            $this->rowClass = $rowClass;
        }
        if (!empty($cellClass)) {
            $this->cellClass = $cellClass;
        }
        if ($tag === 'div') {
            $this->tags = ['row' => 'div', 'cell' => 'div'];
        }
    }

    protected function __build_extra__()
    {
        ksort($this->data);
        foreach ($this->data as $row){
            ksort($row);
            $this->add($this->rowFactory($row));
        }
    }

    private function rowFactory($row)
    {
        $result = new Tag($this->tags['row'], null, $this->rowClass);
        foreach($row as $cell){
            foreach ($cell as $content) {
                $result->add($this->cellFactory($content));
            }
        }
        return $result;
    }

    protected function cellFactory($cell)
    {
        $result = new Tag($this->tags['cell'], null, $this->cellClass);
        $result->add($this->labelFactory($cell['label']));
        $result->add($cell['content']);
        return $result;
    }

    protected function labelFactory($labelValue)
    {
        $label = new Tag('label');
        $label->add(trim($labelValue));
        return $label;
    }

    public function put($label, $content, $row = 0, $col = 0)
    {
        if (!array_key_exists($row, $this->data)) {
            $this->data[$row] = [];
        }
        if (!array_key_exists($col, $this->data[$row])) {
            $this->data[$row][$col] = [];
        }
        $this->data[$row][$col][] = ['label' => $label, 'content'=> $content];
    }
}
