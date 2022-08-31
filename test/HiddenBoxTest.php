<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\HiddenBox;

final class HiddenBoxTest extends TestCase
{
    public function testHiddenBox(): void
    {
        $HiddenBox = new HiddenBox('test');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test" value="">',
            (string) $HiddenBox
        );
    }

    public function testHiddenBoxConstructWithClass(): void
    {
        $Button = new HiddenBox('testName', 'testId', 'testClass');
        $this->assertEquals(
            '<input id="testId" type="hidden" name="testName" class="testClass" value="">',
            (string) $Button
        );
    }

    public function testHiddenBoxValue(): void
    {
        $_REQUEST['test'] = 'testValue';
        $HiddenBox = new HiddenBox('test');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test" value="testValue">',
            (string) $HiddenBox
        );
    }
}
