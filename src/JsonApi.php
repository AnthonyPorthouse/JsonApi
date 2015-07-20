<?php

namespace JsonApi;

use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class JsonApi implements Jsonable, JsonSerializable
{
    /**
     * @var ResourceObject[]
     */
    protected $data;
    protected $errors;
    protected $meta;
    protected $jsonapi;

    /* @var Links $links */
    public $links;
    protected $included;

    public function __construct()
    {
        $this->data = [];
        $this->errors = [];
        $this->meta = [];
        $this->jsonapi = [];
        $this->links = new Links();
        $this->included = [];

        $this->setJsonApiData();
    }

    private function setJsonApiData()
    {
        $this->jsonapi['version'] = '1.0';
    }

    /**
     * Adds a Resource to the Data.
     *
     * @param ResourceObject $resource
     */
    public function addDataElement(ResourceObject $resource)
    {
        $this->data[] = $resource;
    }

    /**
     * @inheritdoc
     */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }

    public function jsonSerialize()
    {
        $response = [];

        if (count($this->errors)) {
            $response['errors'] = $this->errors;
        } else {
            $response['data'] = $this->data;
        }

        if (count($this->meta)) {
            $response['meta'] = $this->meta;
        }

        if (count($this->jsonapi)) {
            $response['jsonapi'] = $this->jsonapi;
        }

        if (count($this->links->getLinks())) {
            $response['links'] = $this->links;
        }

        return $response;
    }
}
