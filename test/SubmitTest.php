<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\Submit;

final class SubmitTest extends TestCase
{
    public function testSubmit(): void
    {
        $Button = new Submit('test', 'Test');
        $this->assertEquals(
            '<button id="test" name="test" type="submit">Test</button>',
            (string) $Button
        );
    }

    public function testSubmitConstructWithClass(): void
    {
        $Button = new Submit('test', 'Test', 'testClass');
        $this->assertEquals(
            '<button id="test" name="test" type="submit" class="testClass">Test</button>',
            (string) $Button
        );
    }

    public function testSubmitDisabled(): void
    {
        $Button = new Submit('test', 'Test');
        $Button->setDisabled(true);
        $this->assertEquals(
            '<button id="test" name="test" type="submit" disabled="disabled">Test</button>',
            (string) $Button
        );
    }

    public function testSubmitWithAction(): void
    {
        $Button = new Submit('test', 'Test');
        $Button->setAction('test', '#p1,value');
        $this->assertEquals(
            '<button id="test" name="test" type="submit" class="click-execute" data-action="test" data-action-parameters="#p1,value">Test</button>',
            (string) $Button
        );
    }
}
