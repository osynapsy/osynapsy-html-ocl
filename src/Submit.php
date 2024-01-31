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

class Submit extends Button
{
    public function __construct($id, $label = '', $class = '')
    {
        parent::__construct($id, $label, $class);
        $this->attribute('type', 'submit');
    }
}
