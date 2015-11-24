<?php
namespace Darktec\Router;

use Doctrine\Common\Cache\ApcCache;

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
    public static function map(string $method, string $uri, $action) {
        $route = new Route($method, $uri, $action);
        self::$container->get('routeCollection')->add($route);
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
                break;
            }

            // Check for / route
            if ($route->uri == '/' && $uri == '/') {
                new RouteCallback($route->action);
                return;
            }
            $reg = $route->regex;
            preg_match($reg, $uri, $arr);
            if (count($arr) > 0) {
                new RouteCallback($route->action);
                return;
            }

        }
        throw new \Exception;
    }

    /**
     *
     */
    public static function init() {
        $builder = new \DI\ContainerBuilder();
        $builder->setDefinitionCache(new ApcCache());
        $builder->writeProxiesToFile(true, 'tmp/proxies');

        self::$container = $builder->build();
        self::$container->set('routeCollection', new RouteCollection());
    }

}