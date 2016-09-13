<?php

class App_Ro_Test_UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BEAR_Resource
     */
    public $resource;

    public function setUp()
    {
        $this->resource = BEAR::dependency('BEAR_Resource');
        parent::setUp();
    }

    public function testReadCode()
    {
        $params = [
            'uri' => 'Test/User',
            'values' => ['id' => 1],
            'options' => []
        ];
        $ro = $this->resource->read($params)->getRo();
        $this->assertSame(200, $ro->getCode());

        return $ro;
    }

    /**
     * @param App_Ro $ro
     *
     * @depends testReadCode
     */
    public function testReadBody(App_Ro $ro)
    {
        $body = $ro->getBody();
        $this->assertSame("BEAR", $body['name']);
    }
}
