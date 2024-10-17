<?php
namespace Darktec\Router;

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


    /**
     * Route constructor.
     *
     * @param string $method
     * @param string $uri
     * @param mixed $action
     */
    public function __construct(string $method, $uri, $action)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;

        $this->regex();
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

    public function __call($name, $arguments)
    {
        if(is_callable(array($this, $name))) {
            return call_user_func_array($this->action, $arguments);
        }
    }

}