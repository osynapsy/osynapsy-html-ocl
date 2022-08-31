<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\IFrame;

final class IFrameTest extends TestCase
{
    public function testIFrame(): void
    {
        $IFrame = new IFrame('test');
        $this->assertEquals(
            '<iframe id="test" name="test"></iframe>',
            (string) $IFrame
        );
    }

    public function testIFrameWithSource(): void
    {
        $IFrame = new IFrame('test', 'http://test.com');
        $this->assertEquals(
            '<iframe id="test" name="test" src="http://test.com"></iframe>',
            $this->cleanString((string) $IFrame)
        );
    }

    protected function cleanString($value)
    {
        return str_replace([PHP_EOL, "\t"],'', $value);
    }
}
