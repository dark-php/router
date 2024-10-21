<?php
namespace Darktec\Router;

use Darktec\Util\Collection;

/**
 * @inheritdoc
 */
class RouteCollection extends Collection
{
    /**
     * The array of routes
     *
     * @var \Darktec\Router\Route[]
     */
    public $items = array();

}