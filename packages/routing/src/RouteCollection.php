<?php

namespace CueBlog\Routing;

use CueBlog\Routing\Route;

/**
 * 路由层
 */
class RouteCollection
{
    /**
     * 路由表
     * @var array
     */
    protected $_routes = [];
    
	/**
	 * 将路由信息载入到内存中的routes
	 * @param string $name
	 * @param \CueBlog\Routing\Route $route
	 * @return $this
	 */
    public function add( string $name , Route $route )
    {
        $this->_routes[$name] = $route;
        return $this;
    }

    /**
     * 
     * 获取所有路由
     * @return array
     */
    public function getRoutes()
    {
        return $this->_routes;
    }

    
	/**
	 * 获取某个路由
	 * @param $name
	 * @return array
	 */
    public function getRoute( $name )
    {
        return isset( $this->_routes[$name] ) ? (array)$this->_routes[$name] : [];
    }
}
