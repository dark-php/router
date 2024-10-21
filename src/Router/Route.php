<?php
namespace DarkTec\Router;

use DarkTec\Starter\Helpers\Container;

class Route
{

    /**
     * The URI pattern for the route
     *
     * @var string
     */
    public string $uri;

    /**
     * The HTTP method for the route
     *
     * @var string
     */
    public string $method;

    /**
     * The callback action for the route
     *
     * @var string
     */
    public $action;

    /**
     * The regular expression for the route
     *
     * @var string
     */
    public string $regex;

    public $middleware;

    public function __construct($method, $uri, $action, $middleware = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
        $this->middleware = $middleware;
        
        $this->regex();
    }

    /**
     * Register a new GET route with the router.
     *
     * @param  string  $uri
     * @param  array|string|callable|null  $action
     * @return \Illuminate\Routing\Route
     */
    public static function get($uri, $action = null)
    {
        return self::addRoute('GET', $uri, $action);
    }

    /**
     * Register a new POST route with the router.
     *
     * @param  string  $uri
     * @param  array|string|callable|null  $action
     * @return \Illuminate\Routing\Route
     */
    public static function post($uri, $action = null)
    {
        return self::addRoute('POST', $uri, $action);
    }

    /**
     * Register a new PUT route with the router.
     *
     * @param  string  $uri
     * @param  array|string|callable|null  $action
     * @return \Illuminate\Routing\Route
     */
    public static function put($uri, $action = null)
    {
        return self::addRoute('PUT', $uri, $action);
    }

    /**
     * Register a new PATCH route with the router.
     *
     * @param  string  $uri
     * @param  array|string|callable|null  $action
     * @return \Illuminate\Routing\Route
     */
    public static function patch($uri, $action = null)
    {
        return self::addRoute('PATCH', $uri, $action);
    }

    /**
     * Register a new DELETE route with the router.
     *
     * @param  string  $uri
     * @param  array|string|callable|null  $action
     * @return \Illuminate\Routing\Route
     */
    public static function delete($uri, $action = null)
    {
        return self::addRoute('DELETE', $uri, $action);
    }
    
    /**
     * Computes the regular expression for the route
     *
     * @return void
     */
    public function regex() {
        // split uri
        $arr = preg_split('@/@', $this->uri, NULL, PREG_SPLIT_NO_EMPTY);

        $regex = null;
        foreach ($arr as $ar) {
            // Replace dynamic with regex
            $regex = $regex.'\/'.preg_replace('/\{(.*?)\}/', '[0-9A-Za-z]++', $ar);
        }

        $this->regex = '/^'.$regex.'$/';
    }

    /**
     * 
     */
    public static function middleware($mw) {
        return new Route('', '', '', $mw);
    }

    public function group($routes) {
        foreach ($routes as $route) {
            $route->middleware = $this->middleware;
            Container::getInstance()->get('routeCollection')->add($route->method . ' ' . $route->uri, $route);
        }
    }

    public static function addRoute($method, $uri, $action) {
        $route = new Route($method, $uri, $action);
        Container::getInstance()->get('routeCollection')->add($method . ' ' .$uri, $route);
        return $route;
    }

}