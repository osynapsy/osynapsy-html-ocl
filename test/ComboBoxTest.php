<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\ComboBox;
require_once 'StringClean.php';

final class ComboBoxTest extends TestCase
{
    use StringClean;

    public function testComboBox(): void
    {
        $ComboBox = new ComboBox('test');
        $this->assertEquals(
            '<select id="test" name="test"><option value="" selected="selected">- Seleziona -</option></select>',
            $this->tabAndEolRemove((string) $ComboBox)
        );
    }

    public function testComboBoxDisabled(): void
    {
        $ComboBox = new ComboBox('test');
        $ComboBox->setDisabled(true);
        $this->assertEquals(
            '<select id="test" name="test" disabled="disabled"><option value="" selected="selected">- Seleziona -</option></select>',
            $this->tabAndEolRemove((string) $ComboBox)
        );
    }

    public function testComboBoxWithOptions(): void
    {
        $ComboBox = new ComboBox('test');
        $ComboBox->setData([['1', 'Option1'], ['2', 'Option2']]);
        $this->assertEquals(
            '<select id="test" name="test"><option value="" selected="selected">- Seleziona -</option><option value="1">Option1</option><option value="2">Option2</option></select>',
            $this->tabAndEolRemove((string) $ComboBox)
        );
    }

    public function testComboBoxAderence(): void
    {
        $_REQUEST['comboAderenceTest'] = '2';
        $ComboBox = new ComboBox('comboAderenceTest');
        $ComboBox->setData([['1', 'Option1'], ['2', 'Option2']]);
        $this->assertEquals(
            '<select id="comboAderenceTest" name="comboAderenceTest"><option value="">- Seleziona -</option><option value="1">Option1</option><option value="2" selected="selected">Option2</option></select>',
            $this->tabAndEolRemove((string) $ComboBox)
        );
    }
}
