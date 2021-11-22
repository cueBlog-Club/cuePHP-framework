<?php

declare(strict_types=1);

namespace SolaTyolo\Lightioc\Resolver;

use ReflectionClass;
use ReflectionException;

class Reflection
{
    protected $classes = [];

    protected $params = [];

    protected $traits = [];

    public function getClass(string $className): ReflectionClass
    {
        if (!isset($this->classes[$className])) {
            $this->classes[$className] = new ReflectionClass($className);
        }
        return $this->classes[$className];
    }

    public function getParams($className): array
    {
        if (!isset($this->params[$className])) {
            $this->params[$className] = [];
            $constructor = $this->getClass($className)->getConstructor();
            if ($constructor) {
                $this->params[$className] = $constructor->getParameters();
            }
        }

        return $this->params[$className];
    }
}
