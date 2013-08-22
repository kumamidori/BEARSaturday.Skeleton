<?php

namespace Saturday\Setup;

class SetupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Setup
     */
    protected $skeleton;

    protected function setUp()
    {
        $this->skeleton = new Setup;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Saturday\Setup\Setup', $actual);
    }

    /**
     * @expectedException \Saturday\Setup\Exception\LogicException
     */
    public function test_Exception()
    {
        throw new Exception\LogicException;
    }
}
