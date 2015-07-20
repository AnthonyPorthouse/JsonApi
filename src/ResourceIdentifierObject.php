<?php

namespace JsonApi;

class ResourceIdentifierObject
{
    protected $id;
    protected $type;
    protected $meta;

    public function __construct($type, $id)
    {
        $this->type = (string) $type;
        $this->id = (string) $id;
        $this->meta = [];
    }

    /** @inheritdoc */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }

    public function jsonSerialize()
    {
        $response = [
          'id' => $this->id,
          'type' => $this->type,
        ];

        if (count($this->meta)) {
            $response['meta'] = $this->meta;
        }

        return $response;
    }
}
