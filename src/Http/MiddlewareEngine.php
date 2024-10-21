<?php


namespace Darktec\Http;


class MiddlewareEngine
{
    private Request $request;
    private static array $middlewares;

    public function __construct(Request $request)
    {
        $this->request = $request;
        self::$middlewares = [];
    }

    public static function handler($class)
    {
        $key = array_search($class, self::$middlewares);
        if (array_key_exists($key+1, self::$middlewares)){
            return new self::$middlewares[$key+1];
        }
        return false;
    }

    public function addMiddleware($middleware) {

        if (is_array($middleware)) {
            self::$middlewares = array_merge(self::$middlewares, $middleware);
        } else {
            array_push(self::$middlewares, $middleware);
        }
    }
    
    public function run()
    {

        foreach (self::$middlewares as $class) {
            if (class_exists($class)){
                $class = new $class;
                if (method_exists($class, 'handle')){
                    $class->handle($this->request);
                }
            }
        }
    }
}