<?php
namespace Darktec\Router\Http;


use Darktec\Error\InvalidKeyException;

class Request
{
    /**
     * Request body parameters ($_POST).
     *
     * @var \Darktec\Util\Map
     */
    private static $post;
    /**
     * Query string parameters ($_GET).
     *
     * @var \Darktec\Util\Map
     */
    private static $get;
    /**
     * Server parameters ($_SERVER).
     *
     * @var \Darktec\Util\Map
     */
    private static $server;
    /**
     * Uploaded files ($_FILES).
     *
     * @var \Darktec\Util\Map
     */
    private static $files;
    /**
     * Cookies ($_COOKIE).
     *
     * @var \Darktec\Util\Map
     */
    private static $cookies;

    /**
     * Initialises the Request and sets attributes
     */
    public static function init()
    {
        self::$post = new ParameterBag();
        foreach ($_POST as $k => $v) {
            self::$post->add(strtolower($k), $v);
        }
        self::$get = new ParameterBag();
        foreach ($_GET as $k => $v) {
            self::$get->add(strtolower($k), $v);
        }
        self::$server = new ParameterBag();
        foreach ($_SERVER as $k => $v) {
            self::$server->add(strtolower($k), $v);
        }
        self::$files = new ParameterBag();
        foreach ($_FILES as $k => $v) {
            self::$files->add(strtolower($k), $v);
        }
        self::$cookies = new ParameterBag();
        foreach ($_COOKIE as $k => $v) {
            self::$cookies->add(strtolower($k), $v);
        }
    }

    /**
     * Gets a value from the post ParameterBag
     *
     * @param string $key
     * @return string
     */
    public static function post(string $key)
    {
        try {
            return self::$post->get(strtolower($key));
        } catch (InvalidKeyException $e) {
            die($e);
        }
    }

    /**
     * Gets a value from the get ParameterBag
     *
     * @param string $key
     * @return string
     */
    public static function get(string $key)
    {
        try {
            return self::$get->get(strtolower($key));
        } catch (InvalidKeyException $e) {
            die($e);
        }
    }

    /**
     * Gets a value from the server ParameterBag
     *
     * @param string $key
     * @return string
     */
    public static function server(string $key)
    {
        try {
            return self::$server->get(strtolower($key));
        } catch (InvalidKeyException $e) {
            die($e);
        }
    }

    /**
     * Gets a value from the files ParameterBag
     *
     * @param string $key
     * @return string
     */
    public static function files(string $key)
    {
        try {
            return self::$files->get(strtolower($key));
        } catch (InvalidKeyException $e) {
            die($e);
        }
    }

    /**
     * Gets a value from the cookies ParameterBag
     *
     * @param string $key
     * @return string
     */
    public static function cookies(string $key)
    {
        try {
            return self::$cookies->get(strtolower($key));
        } catch (InvalidKeyException $e) {
            die($e);
        }
    }

}