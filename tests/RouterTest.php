<?php
namespace DarkPHP\Tests;

use DarkPHP\Router\Router;
use DarkPHP\Router\RouteCollection;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testRouterInit()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->enableDefinitionCache();
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