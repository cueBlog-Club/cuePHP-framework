<?php
declare(strict_types=1);

namespace CuePhp\Routing;

/**
 * http request context
 */
class Context
{
    private $_uri = '';

    private $_method = '';

    /**
     * dynamatic params in uri
     */
    private $_params = [];


    public function __construct()
    {
        $this->resolveFromServerRequest();
    }
    
    public function resolveFromServerRequest()
    {
        $this->setUrl($_SERVER['REQUEST_URI']);
        $this->setMethod($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->_method;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $url = str_replace(getenv('BASE_PATH'), '', $_SERVER['REQUEST_URI']);
        $this->_uri = $url;
    }
    
    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->_method = strtoupper($method);
    }

    /**
     * @param string $key
     */
    public function param(string $key): string
    {
        return $this->_params[$key] ?? "";
    }
}
