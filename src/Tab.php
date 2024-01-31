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

class Tab extends Component
{
    public function __construct($name)
    {
        parent::__construct('div', $name);
        $this->attribute('class', 'tabs');
        $this->add(new HiddenBox($name));
    }

    protected function __build_extra__()
    {
        $head = $this->add(new Tag('ul'));
        ksort($this->data);
        $i = 0;
        foreach($this->data as $cards) {
            ksort($cards);
            foreach($cards as $card) {
                $this->cardactory($i, $head, $card);
            }
        }
    }

    protected function rowFactory(&$i, $head, $contents)
    {
        foreach($contents as $content) {
            $head->add('<li><a href="#'.$this->id.'_'.$i.'" idx="'.$i.'"><p><span>'.$content['label']."</span></p></a></li>");
            $div = $this->add(new Tag('div', $this->id.'_'.$i));
            $div->add($content['content']);
            $i++;
        }
    }

    public function put($label, $content, $row = 0, $col = 0)
    {
        $this->data[$row][$col][] = ['lbl' => $label, 'obj' => $content];
    }
}