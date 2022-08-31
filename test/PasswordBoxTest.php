<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Ocl\PasswordBox;
require_once 'StringClean.php';

final class PasswordBoxTest extends TestCase
{
    public function testPasswordBox(): void
    {
        $PasswordBox = new PasswordBox('test');
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" value="">',
            (string) $PasswordBox
        );
    }

    public function testPasswordBoxValue(): void
    {
        $_REQUEST['passwordBoxTest'] = 'hello word!';
        $PasswordBox = new PasswordBox('passwordBoxTest');
        $this->assertEquals(
            '<input id="passwordBoxTest" type="password" name="passwordBoxTest" autocomplete="off" value="hello word!">',
            (string) $PasswordBox
        );
    }

    public function testPasswordBoxWithAction(): void
    {
        $PasswordBox = new PasswordBox('test');
        $PasswordBox->setAction('test', '#p1,value');
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" class="change-execute" data-action="test" data-action-parameters="#p1,value" value="">',
            (string) $PasswordBox
        );
    }
}

