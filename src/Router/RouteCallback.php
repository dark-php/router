<?php
namespace Darktec\Router;


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

            $class = new \ReflectionClass($arr[0]);
            $method = $class->getMethod($arr[1]);
            if ($method !== null) {
                $method->invoke($class->newInstance());
            }
        } else {
            $action();
        }
    }

}