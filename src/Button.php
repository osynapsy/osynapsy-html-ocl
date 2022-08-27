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
/*
 * Button component
 */
class Button extends Component
{
    public function __construct($id = null, $label = '', $class = '')
    {
        parent::__construct('button', $id);
        $this->att('name', $id);
        $this->att('type', 'button');
        $this->add($label);
        if (!empty($class)) {
            $this->setClass($class);
        }
    }
}
