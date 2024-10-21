<?php

namespace DarkTec\Router;

use DarkTec\Starter\Helpers\Container;

class Router
{
    public static $container;

    /**
     * Creates a route and adds it to the collection
     *
     * @param string $method
     * @param string $uri
     * @param mixed $action
     * @return void
     * @throws \DI\NotFoundException
     */
    public static function map(string $method, $uri, $action, $middleware = [])
    {
        $route = new Route($method, $uri, $action, $middleware);
        self::$container->get('routeCollection')->add($method . ' ' . $uri, $route);
        return $route;
    }

    /**
     * Attempts to match a route to the request URI
     * @param string $method
     * @param string $uri
     * @throws \DI\NotFoundException
     * @throws \Exception
     */
    public static function match(string $method, string $uri)
    {
        // Iterate routes
        foreach (self::$container->get('routeCollection')->items as $route) {
            // CHeck method
            if ($route->method != $method) {
                continue;
            }

            // Check for / route
            if ($route->uri == '/' && $uri == '/') {
                $engine = self::$container->get('middlewareEngine');
                $engine->addMiddleware($route->middleware);
                $engine->run();
                new RouteCallback(self::$container, $route->action);
                return;
            }

            $reg = $route->regex;
            preg_match($reg, $uri, $arr);
            if (count($arr) > 0) {
                $engine = self::$container->get('middlewareEngine');
                $engine->addMiddleware($route->middleware);
                $engine->run();
                new RouteCallback(self::$container, $route->action);
                return;
            }
        }

        throw new \Exception('Route does not exist');
    }

    /**
     *
     */
    public static function init($container = null)
    {

        self::$container = $container ? $container : Container::getInstance();
        self::$container->set('routeCollection', new RouteCollection());
    }
}
