<?php
declare(strict_types=1);

namespace CuePhp\Routing;

use Closure;
use CuePhp\Routing\Exception\RouterParamInvalidException;

/**
 * single route
 */
class Route
{
    /**
     * Http Uri
     * @var string
     */
    private $_path = '/';

    /**
     * Http Method
     * @var string
     */
    private $_method = "";

    /**
     * @var Closure
     */
    private $_func = null;

    public function __construct(string $method, string $path, Closure $func)
    {
        $this->setPath($path);
        $this->setMethod($method);
        $this->setFunc($func);
    }
    
    /**
     * @return string
     */
    public function getPath():string
    {
        return $this->_path;
    }
    
    /**
     * @return string
     */
    public function getMethod():string
    {
        return $this->_method;
    }

    public function getFunc(): Closure
    {
        return $this->_func;
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

    public function setMethod(string $method): void
    {
        if ($method === "") {
            throw new RouterParamInvalidException();
        }
        $this->_method = strtoupper($method);
    }

    public function setFunc(Closure $func): void
    {
        if (is_callable($func) === false) {
            throw new RouterParamInvalidException();
        }
        $this->_func = $func;
    }
}
