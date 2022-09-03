<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\ComboBoxTree;
require_once 'StringClean.php';

final class ComboBoxTreeTest extends TestCase
{
    use StringClean;

    public function testComboBoxTree(): void
    {
        $ComboBoxTree = new ComboBoxTree('test');
        $this->assertEquals(
            '<select id="test" name="test"><option value="" selected="selected">Seleziona .....</option></select>',
            $this->tabAndEolRemove((string) $ComboBoxTree)
        );
    }

    public function testComboBoxTreeDisabled(): void
    {
        $ComboBoxTree = new ComboBoxTree('test');
        $ComboBoxTree->setDisabled(true);
        $this->assertEquals(
            '<select id="test" name="test" disabled="disabled"><option value="" selected="selected">Seleziona .....</option></select>',
            $this->tabAndEolRemove((string) $ComboBoxTree)
        );
    }

    public function testComboBoxTreeWithOptions(): void
    {
        $ComboBoxTree = new ComboBoxTree('test');
        $ComboBoxTree->setData([['1', 'Option1'], ['2', 'Option2']]);
        $this->assertEquals(
            '<select id="test" name="test"><option value="" selected="selected">Seleziona .....</option><option value="1">Option1</option><option value="2">Option2</option></select>',
            $this->tabAndEolRemove((string) $ComboBoxTree)
        );
    }

    public function testComboBoxTreeCheckTree(): void
    {
        $ComboBoxTree = new ComboBoxTree('comboTreeTest');
        $ComboBoxTree->setData([['1', 'Option1'], ['2', 'Option2'], ['3', 'Option3' , '1'], ['4', 'Option4']]);
        $this->assertEquals(
            '<select id="comboTreeTest" name="comboTreeTest"><option value="" selected="selected">Seleziona .....</option><option value="1">Option1</option><option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option3</option><option value="2">Option2</option><option value="4">Option4</option></select>',
            $this->tabAndEolRemove((string) $ComboBoxTree)
        );
    }

    public function testComboBoxTreeAderence(): void
    {
        $_REQUEST['comboTreeAderenceTest'] = '2';
        $ComboBoxTree = new ComboBoxTree('comboTreeAderenceTest');
        $ComboBoxTree->setData([['1', 'Option1'], ['2', 'Option2' , '1'], ['3', 'Option3'], ['4', 'Option4' , '1']]);
        $this->assertEquals(
            '<select id="comboTreeAderenceTest" name="comboTreeAderenceTest"><option value="">Seleziona .....</option><option value="1">Option1</option><option value="2" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option2</option><option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option4</option><option value="3">Option3</option></select>',
            $this->tabAndEolRemove((string) $ComboBoxTree)
        );
    }
}
