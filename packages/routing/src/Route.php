<?php

namespace CueBlog\Routing;

/**
 * 单个路由
 */
class Route
{
    /**
     * 请求路由
     */
    private $_path = '/';

    /**
     * 可接受的请求方式
     */
    private $_methods = ['GET'];

    /**
     * 可接受的请求头
     */
    private $_schemas = ['HTTP', 'HTTPS'];

    /**
     * 对应的控制器
     */
    private $_controller = 'index';

    /**
     * 对应的执行方法
     */
    private $_action = 'index';

    public function __construct(string $path, array $params = [])
    {
        $this->setPath($path);
        $this->setMethods(isset($params['methods']) ? $params['methods'] : ['GET']);
        $this->setController(isset($params['controller']) ? $params['controller'] : 'index');
        $this->setAction(isset($params['action']) ? $params['action'] : 'index');
    }
	
	/**
	 * 获取参数
	 * @return array
	 */
    public function getParams()
    {
    	return [
    	    'path' => $this->_path ,
		    'method' => $this->_methods ,
		    'controller' => $this->_controller ,
		    'action' => $this->_action
	    ];
    }
	
	/**
	 * @return string
	 */
    public function getPath()
    {
        return $this->_path;
    }
	
	/**
	 * @return array
	 */
    public function getMethods()
    {
        return $this->_methods;
    }

    public function getSchemas()
    {
        return $this->_schemas;
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getAction()
    {
        return $this->_action;
    }
	
	/**
	 * @param String $path
	 * @return $this
	 */
    public function setPath(String $path)
    {
        $this->_path = $path;
        return $this;
    }
	
	/**
	 * @param array $methods
	 * @return $this
	 */
    public function setMethods(array $methods)
    {
        $this->_methods = array_map('strtoupper', $methods);
        return $this;
    }
	
	/**
	 * @param array $schemas
	 * @return $this
	 */
    public function setSchemas(array $schemas)
    {
        $this->_schemas = array_map('strtoupper', $schemas);
        return $this;
    }
	
	/**
	 * @param string $controller
	 * @return $this
	 */
    public function setController(string $controller)
    {
        $this->_controller = $controller;
        return $this;
    }
	
	/**
	 * @param $action
	 * @return $this
	 */
    public function setAction($action)
    {
        $this->_action = $action;
        return $this;
    }
}
