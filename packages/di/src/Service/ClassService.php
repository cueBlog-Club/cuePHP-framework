<?php
declare(strict_types=1);

namespace CuePhp\DI\Service;

class ClassService implements ServiceInterface
{

    /**
     * @var string
     */
    private $_class;

    /**
     * @var array
     */
    private $_primitives = [];

    private $_resolveAsSington;

    public function __construct(string $class, array $primitives, bool  $resolveAsSington)
    {
        $this->_class = $class;
        $this->_primitives = $primitives;
        $this->_resolveAsSington = $resolveAsSington;
    }

    public function getClass(): string
    {
        return $this->_class;
    }

    public function getPrimitives(): array
    {
        return $this->_primitives;
    }

    public function resolveAsSingleton(): bool
    {
        return $this->_resolveAsSington;
    }
}
