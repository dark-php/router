<?php
namespace Darktec\Router;
use DI\Container;


class RouteCallback
{
    /**
     * Calls the given controller@method using Reflection
     *
     * @param string $action The action to call
     */
    public function __construct($action)
    {
        // Check if action is string or function
        if (is_string($action)) {
            // Create array from action
            $arr = explode('@', $action);

            $container = new Container();
            $res = $container->call($arr[0] . "::index");

            if (gettype($res) === "string") echo $res;
            
        } else {
            $action();
        }
    }

}