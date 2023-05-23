<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\TextArea;
require_once 'StringClean.php';

final class TextAreaTest extends TestCase
{
    public function testTextArea(): void
    {
        $TextArea = new TextArea('test');
        $this->assertEquals(
            '<textarea id="test" name="test"></textarea>',
            (string) $TextArea
        );
    }

    public function testTextAreaValue(): void
    {
        $_REQUEST['textAreaTest'] = 'hello word!';
        $TextArea = new TextArea('textAreaTest');
        $this->assertEquals(
            '<textarea id="textAreaTest" name="textAreaTest">hello word!</textarea>',
            (string) $TextArea
        );
    }

    public function testTextAreaWithAction(): void
    {
        $TextArea = new TextArea('test');
        $TextArea->setAction('test', '#p1,value');
        $this->assertEquals(
            '<textarea id="test" name="test" class="change-execute" data-action="test" data-action-parameters="#p1,value"></textarea>',
            (string) $TextArea
        );
    }
}
