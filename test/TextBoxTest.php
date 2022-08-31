<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\TextBox;
require_once 'StringClean.php';

final class TextBoxTest extends TestCase
{
    public function testTextBox(): void
    {
        $TextBox = new TextBox('test');
        $this->assertEquals(
            '<input id="test" type="text" name="test" value="">',
            (string) $TextBox
        );
    }

    public function testTextBoxValue(): void
    {
        $_REQUEST['textBoxTest'] = 'hello word!';
        $TextBox = new TextBox('textBoxTest');
        $this->assertEquals(
            '<input id="textBoxTest" type="text" name="textBoxTest" value="hello word!">',
            (string) $TextBox
        );
    }

    public function testTextBoxWithAction(): void
    {
        $TextBox = new TextBox('test');
        $TextBox->setAction('test', '#p1,value');
        $this->assertEquals(
            '<input id="test" type="text" name="test" class="change-execute" data-action="test" data-action-parameters="#p1,value" value="">',
            (string) $TextBox
        );
    }
}

