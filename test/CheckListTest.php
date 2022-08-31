<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\CheckList;
require_once 'StringClean.php';

final class CheckListTest extends TestCase
{
    use StringClean;

    public function testCheckList(): void
    {
        $CheckList = new CheckList('test');
        $this->assertEquals(
            '<div id="test" class="ocl-checklist"></div>',
            $this->tabAndEolRemove((string) $CheckList)
        );
    }

    public function testCheckListDisabled(): void
    {
        $CheckList = new CheckList('test');
        $CheckList->setData([['1', 'Check1'], ['2', 'Check2']]);
        $this->assertEquals(
            '<div id="test" class="ocl-checklist">'
            .'<div class="ocl-checklist-row"><span id="test_container"><input id="test" type="checkbox" name="test[]" value="1">&nbsp;Check1</span></div>'
            .'<div class="ocl-checklist-row"><span id="test_container"><input id="test" type="checkbox" name="test[]" value="2">&nbsp;Check2</span></div>'
            .'</div>',
            $this->tabAndEolRemove((string) $CheckList)
        );
    }

    public function testCheckListChecked(): void
    {
        $_REQUEST['checklistTest'] = ['2'];
        $CheckList = new CheckList('checklistTest');
        $CheckList->setData([['1', 'Check1'], ['2', 'Check2']]);
        $this->assertEquals(
            '<div id="checklistTest" class="ocl-checklist">'
            .'<div class="ocl-checklist-row"><span id="checklistTest_container"><input id="checklistTest" type="checkbox" name="checklistTest[]" value="1">&nbsp;Check1</span></div>'
            .'<div class="ocl-checklist-row"><span id="checklistTest_container"><input id="checklistTest" type="checkbox" name="checklistTest[]" value="2" checked="checked">&nbsp;Check2</span></div>'
            .'</div>',
            $this->tabAndEolRemove((string) $CheckList)
        );
    }
}
