<?php

namespace CueBlog\Routing;

/**
 * 请求上下文
 */
class RequestContext
{
    /**
     * 完整路由
     */
    private $_url = '';

    /**
     * 请求方式
     */
    private $_method = 'GET';

    /**
     * 请求host
     */
    private $_host = 'localhost';

    /**
     * 协议头
     */
    private $_schema = 'http';

    /**
     * 请求端口
     */
    private $_port = 80;

    /**
     * 请求参数
     */
    private $_query = '';

    private $_parameters = [];

    public function __construct()
    { }
	
	/**
	 * 从$_SERVER中解析请求
	 */
    public function resolveFromServerRequest()
    {
        $this->setUrl($_SERVER['REQUEST_URI']);
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        $this->setHost($_SERVER['SERVER_NAME']);
        $this->setSchema($_SERVER['REQUEST_SCHEME']);
        $this->setPort($_SERVER['SERVER_PORT']);
    }

    /**
     * 获取URL
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * 获取请求方式
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * 获取host
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * 获取协议头
     */
    public function getSchema()
    {
        return $this->_schema;
    }

    /**
     * 获取端口
     */
    public function getPort()
    {
        return $this->_port;
    }
    
	/**
	 * 设置路由
	 * @param String $url
	 * @return $this
	 */
    public function setUrl(String $url)
    {
        $this->_url = $url;
        return $this;
    }
    
	/**
	 * 设置请求方式
	 * @param String $method
	 * @return $this
	 */
    public function setMethod(String $method)
    {
        $this->_method = strtoupper($method);
        return $this;
    }
    
	/**
	 * 设置host
	 * @param String $host
	 * @return $this
	 */
    public function setHost(String $host)
    {
        $this->_host = $host;
        return $this;
    }
    
	/**
	 * 设置协议头
	 * @param String $schema
	 * @return $this
	 */
    public function setSchema(String $schema)
    {
        $this->_schema = $schema;
        return $this;
    }
    
	/**
	 * 设置端口
	 * @param int $port
	 * @return $this
	 */
    public function setPort(int $port)
    {
        $this->_port = $port;
        return $this;
    }
}
