<?php
/**
 * User: manuel
 * Date: 05-06-2017
 */

namespace Manuel\Http\Response;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Redirect
{
    private $route;
    private $routeParameters;
    private $status;

    /**
     * Redirect constructor.
     *
     * @param $route
     * @param $routeParameters
     * @param $status
     */
    public function __construct($route, array $routeParameters = [], $status = 302)
    {
        $this->route = $route;
        $this->routeParameters = $routeParameters;
        $this->status = $status;
    }

    public static function to($route, array $parameters = [], $status = 302)
    {
        return new static($route, $parameters, $status);
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getRouteParameters(): array
    {
        return $this->routeParameters;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}