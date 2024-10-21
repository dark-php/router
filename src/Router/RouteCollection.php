<?php
namespace DarkPHP\Router;

use DarkPHP\Util\Collection;

/**
 * @inheritdoc
 */
class RouteCollection extends Collection
{
    /**
     * The array of routes
     *
     * @var \DarkPHP\Router\Route[]
     */
    public $items = array();

}