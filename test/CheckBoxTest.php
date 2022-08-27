<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\CheckBox;

final class CheckBoxTest extends TestCase
{
    public function testCheckBox(): void
    {
        $CheckBox = new CheckBox('test');
        $this->assertEquals(
            '<span id="test_container"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1"></span>',
            (string) $CheckBox
        );
    }

    public function testCheckBoxDisabled(): void
    {
        $CheckBox = new CheckBox('test');
        $CheckBox->setDisabled(true);
        $this->assertEquals(
            '<span id="test_container"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" disabled="disabled"></span>',
            (string) $CheckBox
        );
    }

    public function testCheckBoxChecked(): void
    {
        $_REQUEST['test'] = '1';
        $CheckBox = new CheckBox('test');
        $this->assertEquals(
            '<span id="test_container"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" checked="checked"></span>',
            (string) $CheckBox
        );
    }
}
