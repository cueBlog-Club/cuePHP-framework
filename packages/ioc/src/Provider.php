<?php

declare(strict_types=1);

namespace SolaTyolo\Lightioc;

use SolaTyolo\Lightioc\Container;

/**
 * Resolve object specifications
 */
class Provider
{

    /**
     * @var Container
     */
    protected $_container = null;


    public function __construct(Container $container)
    {
        $this->_container  = $container;
    }

    /**
     * resolves an object specification
     * @param string|array $spec
     * @return mixed
     */
    public function __invoke($spec)
    {
        if (is_string($spec)) {
            return $this->resolve($spec);
        }
        if (is_array($spec) && is_string($spec[0])) {
            $spec[0] = $this->resolve($spec[0]);
        }
        return $spec;
    }

    /**
     * get a nemed service or a new instance from then container
     * @param string $spec
     * @return mixed
     */
    protected function resolve($spec)
    {
        if ($this->_container->has($spec)) {
            return $this->_container->get($spec);
        }
        return $this->_container->newInstance($spec);
    }
}
