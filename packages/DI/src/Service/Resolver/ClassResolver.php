<?php

declare(strict_types=1);

namespace CuePhp\DI\Service\Resolver;

use CuePhp\DI\Exception\ResolverException;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use ReflectionUnionType;

use function count;
use function gettype;
use function sprintf;

class ClassResolver implements ResolverInterface
{

    private $_className = "";

    /**
     * @var array
     */
    private $_params = [];

    public function __construct(string $className, array $params = [])
    {
        $this->_className = $className;
        $this->_params = $params;
    }

    /**
     * @return object
     */
    public function resolve(): object
    {
        $reflectionClass = new ReflectionClass($this->_className);
        if ($reflectionClass->isInstantiable() === false) {
            throw new ResolverException(sprintf('%s is not instantiable', $this->_className));
        }
        $constructor = $reflectionClass->getConstructor();
        $parameters =  $constructor !== null ? $constructor->getParameters() : null;
        $className = $this->_className;
        if ($constructor === null) {
            return new $className();
        }
        $constructParams = $this->_resolveParams($parameters ?? []);
        return new $className(...$constructParams);
    }

    /**
     * @var ReflectionParameter[] $unresolveParams
     * @return  array
     * @throws ResolverException
     */
    private function _resolveParams(array $unresolveParams): array
    {
        $resolvedParams = [];

        /**
         * @var ReflectionParameter
         */
        foreach ($unresolveParams as $param) {
            $paramResolved = false;
            $paramType = $param->getType();
            /**
             * @var ReflectionNamedType[]
             */
            $paramTypes = $paramType instanceof ReflectionUnionType ? $paramType->getTypes() : [ $paramType ];

            foreach ($paramTypes as $type) {
                $paramClassName = $type !== null && $type->isBuiltin() === false ? $type->getName() : null;
                if ($paramClassName === null) {
                    $resolvedParam = $this->_resolvePrimitive($param, $type);
                } else {
                    try {
                        $resolvedParam = (new ClassResolver($paramClassName))->resolve();
                    } catch (ResolverException $e) {
                        if ($param->isDefaultValueAvailable()) {
                            $resolvedParam = $param->getDefaultValue();
                        } elseif ($param->allowsNull()) {
                            $resolvedParam = null;
                        } else {
                            throw new ResolverException($e->getMessage());
                        }
                    }
                }
                $resolvedParams[] = $resolvedParam;
                $paramResolved = true;
            }
            if ($paramResolved === false) {
                throw new ResolverException(sprintf('Failed to resovle %', $param->getName()));
            }
        }

        return $resolvedParams;
    }

    /**
     * @var ReflectionParameter $params
     * @var ReflectionType|null $reflectionType
     * @return mixed
     * @throws ResolverException
     */
    private function _resolvePrimitive(ReflectionParameter $params, ?ReflectionType $reflectionType): mixed
    {
        $paramsTypeName = $reflectionType instanceof ReflectionNamedType ? $reflectionType->getName() : (string)$reflectionType;
        if (count($this->_params) > 0) {
            if ($reflectionType !== null && $paramsTypeName !== 'mixed') {
                $primitiveTypeName = gettype($this->_params[0]);
                if ($primitiveTypeName !== $paramsTypeName) {
                    throw new ResolverException(sprintf('Expected type %s , got %s for %s ', $paramsTypeName, $primitiveTypeName, $params->getName()));
                }
            }
            return array_shift($this->_params);
        }
        if ($params->isDefaultValueAvailable()) {
            try {
                return $params->getDefaultValue();
            } catch (ReflectionException $th) {
                throw new ResolverException(sprintf('Failed to get the defaut value for parameter %s', $params->getName()));
            }
        }

        throw new ResolverException(sprintf('No default value available for %s ', $params->getName()));
    }
}
