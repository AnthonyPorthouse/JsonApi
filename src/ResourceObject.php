<?php

namespace JsonApi;

use Illuminate\Contracts\Support\Jsonable;

class ResourceObject implements Jsonable, \JsonSerializable
{
    protected $id;
    protected $type;
    protected $attributes;
    protected $relationships;
    protected $links;
    protected $meta;

    public function __construct($type, $id = null)
    {
        $this->type = (string) $type;

        if (!is_null($id)) {
            $this->id = (string) $id;
        }

        $this->attributes = [];
        $this->relationships = [];
        $this->links = new Links();
        $this->meta = [];
    }

    /**
     * Adds an attribute to the attributes.
     *
     * @param string $name
     * @param string $value
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Sets the attributes to the given array of attributes.
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /** @inheritdoc */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }

    public function jsonSerialize()
    {
        $response = [
            'type' => $this->type,
        ];

        if (!is_null($this->id)) {
            $response['id'] = $this->id;
        }

        if (count($this->attributes)) {
            $response['attributes'] = $this->attributes;
        }

        if (count($this->relationships)) {
            $response['relationships'] = $this->relationships;
        }

        if (count($this->links->getLinks())) {
            $response['links'] = $this->links;
        }

        if (count($this->meta)) {
            $response['meta'] = $this->meta;
        }

        return $response;
    }
}
