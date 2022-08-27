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

//Field hidden
class HiddenBox extends InputBox
{
    public function __construct($name, $id = null)
    {
        parent::__construct('hidden', $name, $id ?? $name);
    }
}
