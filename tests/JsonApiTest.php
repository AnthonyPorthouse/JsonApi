<?php
use JsonApi\JsonApi;

class JsonApiTest extends PHPUnit_Framework_TestCase
{
  public function testCreatesValidJson()
  {
    $api = new JsonApi();

    $this->assertJson($api->toJson());
  }

  public function testMinimumRequirements()
  {
    $api = new JsonApi();
    $response = $api->jsonSerialize();

    // Check for at least one of these
    $keys = array_keys($response);
    $minimum = ['data', 'errors', 'meta'];
    $intersect = array_intersect($keys, $minimum);
    $this->assertGreaterThanOrEqual(1, count($intersect));

    // Cannot contain both errors and a data key
    $both = ['data', 'errors'];
    $intersect = array_intersect($keys, $both);
    $this->assertEquals(1, count($intersect));
  }

  public function testApiVersion()
  {
    $api = new JsonApi();

    $this->assertArrayHasKey('jsonapi', $api->jsonSerialize());
    $this->assertArrayHasKey('version', $api->jsonSerialize()['jsonapi']);
    $this->assertEquals('1.0', $api->jsonSerialize()['jsonapi']['version']);
  }
}
