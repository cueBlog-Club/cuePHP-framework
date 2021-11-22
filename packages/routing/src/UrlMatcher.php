<?php

namespace CueBlog\Routing;

use CueBlog\Routing\RouteCollection;
use CueBlog\Routing\Route;
use CueBlog\Routing\RequestContext;
use CueBlog\Routing\Exception\MethodNotAllowedException;
use CueBlog\Routing\Exception\ResourceNotFoundException;

/**
 * 路由匹配器
 */
class UrlMatcher
{
	/**
	 * 请求上下午文
	 * @var
	 */
	private $_context;
	
	/**
	 * route table
	 * @var \CueBlog\Routing\Route []
	 */
	private $_routes = [];
	
	/**
	 * UrlMatcher constructor.
	 * @param \CueBlog\Routing\RequestContext $context
	 * @param \CueBlog\Routing\RouteCollection $routes
	 */
	public function __construct( RequestContext $context , RouteCollection $routes )
	{
		$this->_context = $context;
		$this->_routes = $routes;
	}
	
	/**
	 * 匹配出符合的路由
	 * @return array
	 * @throws MethodNotAllowedException
	 * @throws ResourceNotFoundException
	 */
	public function match()
	{
		$method = $this->_context->getMethod();
		$url = $this->_context->getUrl();
		
		$matchMethods = [];
		foreach( $this->_routes as $name => $route )
		{
			$requiredMethods = $route->getMethods();
			preg_match( $route->getPath() , $url , $matches );
			if( !empty( $matches ) )
			{
				continue;
			}
			
			if( $requiredMethods && in_array( $method , $requiredMethods , true ) )
			{
				return $route->getParams();
			}
			
			$matchMethods[] = $name;
		}
		
		if( count( $matchMethods ) )
		{
			throw new MethodNotAllowedException( $method );
		}
		
		throw new ResourceNotFoundException( $url );
	}
	
	/**
	 * 设置请求上下文
	 * @param \CueBlog\Routing\RequestContext $context
	 * @return $this
	 */
	public function setContext( RequestContext $context )
	{
		$this->_context = $context;
		return $this;
	}
	
	/**
	 * 设置路由表
	 * @param \CueBlog\Routing\RouteCollection $routes
	 * @return $this
	 */
	public function setRoutes( RouteCollection $routes )
	{
		$this->_routes = $routes;
		return $this;
	}
	
	public function getContext()
	{
		return $this->_context;
	}
	
	public function getRoutes()
	{
		return $this->_routes;
	}
}
