<?php

declare(strict_types=1);

namespace SolaTyolo\Lightioc;

use Closure;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Reflection;
use ReflectionClass;

class Container implements ContainerInterface
{
    /**
     * objects: id ==> className
     */
    protected $objects = [];

    public function set($k, $v)
    {
        $this->objects[$k] = $v;
    }

    public function __set($k, $v)
    {
        $this->objects[$k] = $v;
    }


    public function get(string $id)
    {
        return $this->build($this->objects[$id]);
    }

    public function __get(string $id)
    {
        return $this->build($this->objects[$id]);
    }

    /**
     * autowiring / automatic resolution
     */
    public function build($className)
    {
        if ($className instanceof Closure) {
            return $className($this);
        }

        $reflector = new ReflectionClass($className);

        // exception abstract and interface
        if (!$reflector->isInstantiable()) {
            throw new Exception("cant init");
        }

        $constructor = $reflector->getConstructor();
        // instance director
        if (is_null($constructor)) {
            return new $className;
        }

        // construct params
        $dependencies = $this->getDependencies($constructor->getParameters());
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getDependencies(array $params)
    {
        $dependencies = [];

        foreach ($params as $param) {
            $dependency = $param->getClass();
            if (is_null($dependency)) {
                // 是变量,有默认值则设置默认值
                $dependencies[] = $this->resolveNonClass($param);
            } else {
                // 是一个类，递归解析
                $dependencies[] = $this->build($dependency->name);
            }
        }

        return $dependencies;
    }

    public function resolveNonClass($param)
    {
        // 有默认值则返回默认值
        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new Exception('I have no idea what to do here.');
    }

    public function has(string $id): bool
    {
        return true;
    }
}
