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

class Form extends Component
{
    protected $panel;

    public function __construct($id, $method = 'post')
    {
        parent::__construct('form', $id);
        $this->att('name', $id)->att('method', $method);
        $this->panel = $this->panelFactory($id);
    }

    protected function panelFactory($id)
    {
        return new Panel($id.'_panel');
    }

    public function put($lbl, $obj, $x = 0, $y = 0, $width = 1, $offset = null, $class = '')
    {
        $this->panel->put($lbl, $obj, $x, $y, $width, $offset, $class);
        return $this->panel;
    }
}
