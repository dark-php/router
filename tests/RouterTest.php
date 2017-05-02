<?php
namespace Darktec\Tests;

use Darktec\Router\Router;
use Darktec\Router\RouteCollection;
use DI\Container;
use Doctrine\Common\Cache\ApcCache;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testRouterInit()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->setDefinitionCache(new ApcCache());
        $builder->writeProxiesToFile(true, 'tmp/proxies');

        $container = $builder->build();

        Router::init($container);

        $routeCollection = $container->get('routeCollection');
        $this->assertInstanceOf(RouteCollection::class, $routeCollection);

        return $routeCollection;
    }

    /**
     * @depends testRouterInit
     */
    public function testRouterMapping(RouteCollection $routeCollection)
    {
        Router::map('GET', '/', function () {
            $this->assertTrue(true);
        });

        $route = $routeCollection->get(0);
        $this->assertEquals('GET', $route->method);
        $this->assertEquals('/', $route->uri);

    }

    /**
     * @depends testRouterMapping
     */

    public function testRouterMatching()
    {
        Router::match('GET', '/');
    }
}