<?php

declare(strict_types=1);

namespace CuePhp\DI;

use Psr\Container\ContainerInterface;
use Closure;
use CuePhp\DI\Exception\ResolverException;
use CuePhp\DI\Service\ClassService;
use CuePhp\DI\Service\ClosureService;
use CuePhp\DI\Service\InstanceService;
use CuePhp\DI\Service\Resolver\ClassResolver;
use CuePhp\DI\Service\ServiceTrait;

class Container implements ContainerInterface
{
    use ServiceTrait;

    public function __construct()
    {
        $this->initContext();
    }

    /**
     * @param string $alias
     * @param object $instance
     */
    public function bindInstance(string $alias, object $instance)
    {
        $service = new InstanceService($instance);
        $this->addService($alias, $service);
    }

    /**
     * @var string $alias
     * @var string $class
     * @var array $primitives
     * @var bool
     */
    public function bindClass(string $alias, string $class, array $primitives = [], bool $resolveAsSingleton = false)
    {
        $service = new ClassService($class, $primitives, $resolveAsSingleton);
        $this->addService($alias, $service);
    }

    /**
     * @var string alias
     * @var Closure $fn
     * @var bool $resolveAsSingleton
     */
    public function bindClosure(string $alias, Closure $fn, bool $resolveAsSingleton = false)
    {
        $service = new ClosureService($fn, $resolveAsSingleton);
        $this->addService($alias, $service);
    }


    /**
     * @var string $alias
     * @return object resolved instance
     * @throws ResolverException
     */
    protected function resolve(string $alias): object
    {
        $service = $this->getService($alias);
        if ($service === null) {
            return (new ClassResolver($alias))->resolve();
        }

        if ($service instanceof InstanceService) {
            return $service->getInstance();
        }

        $instance = null;
        if ($service instanceof ClosureService) {
            $fn = $service->getClosure();
            $instance = $fn();
        } elseif ($service instanceof ClassService) {
            $instance = (new ClassResolver($service->getClass(), $service->getPrimitives()))->resolve();
        }

        if ($instance === null) {
            throw new ResolverException('fail to resovler instance');
        }
        if ($service->resolveAsSingleton()) {
            $this->deleteService($alias);
            $this->addService($alias, new InstanceService($instance));
        }
        return $instance;
    }

    public function get($id)
    {
        return $this->resolve($id);
    }

    public function has(string $id)
    {
        return $this->hasService($id);
    }
}
