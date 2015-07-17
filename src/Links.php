<?php

namespace JsonApi;

use Illuminate\Contracts\Support\Jsonable;

class Links implements Jsonable, \JsonSerializable
{
    protected $links;

    public function __construct()
    {
        $this->links = [];
    }

    /**
     * Sets the link Data to the given array.
     *
     * @param array $links An associative array of links, keyed name => link
     */
    public function set(array $links)
    {
        $this->links = $links;
    }

    /**
     * Adds a link to the links section.
     *
     * @param string $name The name of the link
     * @param string $link The link itself
     */
    public function add($name, $link)
    {
        $this->links[$name] = $link;
    }

    /**
     * Returns the array of links.
     *
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /** @inheritdoc */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }

    /** @inheritdoc */
    public function jsonSerialize()
    {
        return $this->links;
    }
}
