<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\CheckBox;
require_once 'StringClean.php';

final class CheckBoxTest extends TestCase
{
    use StringClean;

    public function testCheckBox(): void
    {
        $CheckBox = new CheckBox('test');
        $this->assertEquals(
            '<span id="test_container"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1"></span>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }

    public function testCheckBoxDisabled(): void
    {
        $CheckBox = new CheckBox('test');
        $CheckBox->setDisabled(true);
        $this->assertEquals(
            '<span id="test_container"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" disabled="disabled"></span>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }

    public function testCheckBoxChecked(): void
    {
        $_REQUEST['chkTest'] = '1';
        $CheckBox = new CheckBox('chkTest');
        $this->assertEquals(
            '<span id="chkTest_container"><input type="hidden" name="chkTest" value="0"><input id="chkTest" type="checkbox" name="chkTest" value="1" checked="checked"></span>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }
}
