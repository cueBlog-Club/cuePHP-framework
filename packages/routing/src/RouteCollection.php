<?php

namespace CuePhp\Routing;

use Closure;
use CuePhp\Routing\Exception\ResourceNotFoundException;
use CuePhp\Routing\Route;

final class RouteCollection
{
    /**
     * route conllection, $routes[$method-$path]
     * @var Route[]
     */
    protected $_routes = [];

    /**
     * Parameters from the matched route
     * @var Route
     */
    protected $_matchRoute = null;

    public static function newRouter(): RouteCollection
    {
        return new RouteCollection();
    }
    
    /**
     * inject method and path into route collection
     * @param string $name
     * @param string $route
     * @param Closure $func
     */
    public function add(string $method, string $route, Closure $func)
    {
         // Convert the route to a regular expression: escape forward slashes
         $route = preg_replace('/\//', '\\/', $route);
         // Convert variables e.g. {controller}
         $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
         // Convert variables with custom regular expressions e.g. {id:\d+}
         $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
         // Add start and end delimiters, and case insensitive flag
         $route = '/^' . $route . '$/i';
        $this->_routes[ self::buildRouteKey($method, $route) ] = new Route($method, $route, $func);
    }

    /**
     * get all routes
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->_routes;
    }

    /**
     * get single route by route-key
     * @param string $routeKey
     * @return Route
     */
    public function getRoute(string $routeKey): Route
    {
        return $this->_routes[$routeKey] ?? null;
    }

     /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The Http Url
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match(string $url): bool
    {
        foreach ($this->_routes as $routeKey => $route) {
            preg_match($route->getPath(), $url, $matches);
            if (!empty($matches)) {
                $this->_matchRoute = $route;
                return true;
            }
        }
        return false;
    }


   /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param Context $ctx The Http Context
     *
     * @return void
     */
    public function handle(Context $ctx): void
    {
        $url = self::removeQueryStringVariables($ctx->getUrl());
        if ($this->match($url)) {
            $func = $this->_matchRoute->getFunc();
            $func();
        } else {
            throw new ResourceNotFoundException($ctx->getUrl());
        }
    }

    /**
     * generate route key
     * @param string $method
     * @param string $uri-path
     * @return string
     */
    public static function buildRouteKey(string $method, string $uri): string
    {
        return $method . '-' . $uri;
    }


        /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   '/'                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    public static function removeQueryStringVariables($url)
    {
        $url = substr($url, 1);
        if ($url != '') {
            $parts = explode('?', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}
