<?php
namespace Test;

use DotTpl\View;

class ViewTest extends \PHPUnit_Framework_TestCase
{
    protected function loadTpl()
    {
        return new View(__DIR__ . '/mock.tpl');
    }

    public function testTemplateLoad()
    {
        $view = $this->loadTpl();
        $this->assertInstanceOf('\DotTpl\View', $view);
    }

    public function testAssign()
    {
        $view = $this->loadTpl();
        $view['foo'] = 1;
        $view->bar   = 2;

		$this->assertObjectHasAttribute('foo', $view);
		$this->assertObjectHasAttribute('bar', $view);
    }

    public function testOutput()
    {
        $view = $this->loadTpl();
        $view['foo'] = 1;
        $view->bar   = 2;

        $this->assertEquals('1 + 2 = 3', $view->__toString());
	}
}
