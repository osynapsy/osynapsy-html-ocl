<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\Dummy;

final class DummyTest extends TestCase
{
    public function testDummy(): void
    {
        $Dummy = new Dummy('test');
        $this->assertEquals(
            '<div id="test"></div>',
            (string) $Dummy
        );
    }


}
