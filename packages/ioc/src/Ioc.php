<?php

declare(strict_types=1);

namespace SolaTyolo\Lightioc;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionParameter;

class Bim
{
    public function doSomething()
    {
        echo __METHOD__, "\n";
    }
}

class Bar
{
    private $bim;

    public function __construct(Bim $bim)
    {
        $this->bim = $bim;
    }

    public function doSomething()
    {
        $this->bim->doSomething();
        echo __METHOD__, "\n";
    }
}

class Foo
{
    private $bar;
    private $key;

    public function __construct(Bar $bar, string $k)
    {
        $this->bar = $bar;
        $this->key = $k;
    }

    public function doSomething()
    {
        $this->bar->doSomething();
        echo __METHOD__, "\n";
    }
}

class Container
{
    /**
     * objects: id ==> className
     */
    protected $objects = [];

    public function __set($k, $v)
    {
        $this->objects[$k] = $v;
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
     * @param ReflectionParameter[]  $params
     * @return array
     */
    public function getDependencies(array $params)
    {
        $dependencies = [];

        foreach ($params as $param) {
            $paramType = $param->getType();
            if ($paramType->isBuiltin()) {
                // 是变量,有默认值则设置默认值
                $dependencies[] = $this->resolveNonClass($param);
            } else {
                // 是一个类，递归解析
                $dependencies[] = $this->build($paramType->getName());
            }
        }

        return $dependencies;
    }

    public function resolveNonClass( ReflectionParameter $param)
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


// class Ioc
// {
//     protected static $registry = [];

//     public static function bind($name, Callable $resolver)
//     {
//         static::$registry[$name] = $resolver;
//     }

//     public static function make($name)
//     {
//         if (isset(static::$registry[$name])) {
//             $resolver = static::$registry[$name];
//             return $resolver();
//         }
//         throw new Exception("not found");
//     }
// }

$di = new Container();
    
$di->foo = Foo::class;

/** @var Foo $foo */
$foo = $di->foo;

var_dump($foo);
/*
Foo#10 (1) {
  private $bar =>
  class Bar#14 (1) {
    private $bim =>
    class Bim#16 (0) {
    }
  }
}
*/

$foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething