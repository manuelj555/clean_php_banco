<?php
/**
 * User: manuel
 * Date: 05-06-2017
 */

namespace Manuel\Http\Response;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class View
{
    private $name;
    private $parameters = [];

    /**
     * View constructor.
     *
     * @param $name
     * @param array $parameters
     */
    public function __construct($name, array $parameters)
    {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    public static function make($name, array $parameters = [])
    {
        return new static($name, $parameters);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}