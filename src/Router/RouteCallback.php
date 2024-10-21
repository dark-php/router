<?php
namespace DarkPHP\Router;
use DI\Container;


class RouteCallback
{
    /**
     * Calls the given method
     *
     * @param string $action The action to call
     */
    public function __construct($container, $action)
    {
        // Check if action is string or function
        if (is_string($action)) {
            // Create array from action
            $arr = explode('@', $action);
            
            // Get the class from DI container and call function
            $res = $container->call($arr[0] . "::" . $arr[1]);

            // Output the result if string
            if (gettype($res) === "string") echo $res;
            
        } else {
            $action();
        }
    }

}