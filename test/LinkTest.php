<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\Link;

final class LinkTest extends TestCase
{
    public function testLink(): void
    {
        $Link = new Link('test', '/test', 'Test');
        $this->assertEquals(
            '<a id="test" href="/test">Test</a>',
            (string) $Link
        );
    }

    public function testLinkConstructWithClass(): void
    {
        $Link = new Link('test', '/test',  'Test', 'testClass');
        $this->assertEquals(
            '<a id="test" href="/test" class="testClass">Test</a>',
            (string) $Link
        );
    }

    public function testLinkDisabled(): void
    {
        $Link = new Link('test', '/test', 'Test');
        $Link->setDisabled(true);
        $this->assertEquals(
            '<a id="test" href="/test" disabled="disabled">Test</a>',
            (string) $Link
        );
    }

    public function testLinkWithAction(): void
    {
        $Link = new Link('test', false, 'Test action');
        $Link->setAction('test', '#p1,value');
        $this->assertEquals(
            '<a id="test" href="javascript:void(0);" class="click-execute" data-action="test" data-action-parameters="#p1,value">Test action</a>',
            (string) $Link
        );
    }
}
