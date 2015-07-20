<?php

use JsonApi\ResourceObject;

class ResourceObjectTest extends PHPUnit_Framework_TestCase
{
    /** @var ResourceObject $resourceObject */
    protected $resourceObject;

    public function setUp()
    {
        $this->resourceObject = new ResourceObject('Test');
    }

    public function testConstruction()
    {
        $result = $this->resourceObject->jsonSerialize();

        $this->assertArrayHasKey('type', $result);
        $this->assertArrayNotHasKey('id', $result);

        $this->assertEquals('Test', $result['type']);

        $this->resourceObject = new ResourceObject('Test', 1);
        $result = $this->resourceObject->jsonSerialize();

        $this->assertArrayHasKey('id', $result);
        $this->assertEquals(1, $result['id']);
    }
}
