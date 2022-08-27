<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\Button;

final class ButtonTest extends TestCase
{
    public function testButton(): void
    {
        $Button = new Button('test', 'Test');
        $this->assertEquals(
            '<button id="test" name="test" type="button">Test</button>',
            (string) $Button
        );
    }

    public function testButtonConstructWithClass(): void
    {
        $Button = new Button('test', 'Test', 'testClass');
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="testClass">Test</button>',
            (string) $Button
        );
    }

    public function testButtonDisabled(): void
    {
        $Button = new Button('test', 'Test');
        $Button->setDisabled(true);
        $this->assertEquals(
            '<button id="test" name="test" type="button" disabled="disabled">Test</button>',
            (string) $Button
        );
    }

    public function testButtonWithAction(): void
    {
        $Button = new Button('test', 'Test');
        $Button->setAction('test', '#p1,value');
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="click-execute" data-action="test" data-action-parameters="#p1,value">Test</button>',
            (string) $Button
        );
    }
}
