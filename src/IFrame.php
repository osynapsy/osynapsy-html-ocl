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

//Component iframe
class IFrame extends Component
{
    public function __construct($name, $source = null)
    {
        parent::__construct('iframe', $name);
        $this->att('name',$name);
        if (!empty($source)) {
            $this->att('src', $source);
        }
    }
}
