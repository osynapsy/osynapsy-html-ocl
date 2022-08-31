<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\Panel;
require_once 'StringClean.php';

final class PanelTest extends TestCase
{
    use StringClean;

    public function testPanel(): void
    {
        $Panel = new Panel('test');
        $this->assertEquals(
            '<table id="test"></table>',
            (string) $Panel
        );
    }

    public function testPanelConstructWithClass(): void
    {
        $Panel = new Panel('testName', 'table');
        $Panel->put('TestLabel', 'TestContent');
        $this->assertEquals(
            '<table id="testName"><tr class="row"><td><label>TestLabel</label>TestContent</td></tr></table>',
            $this->tabAndEolRemove((string) $Panel->get())
        );
    }
}
