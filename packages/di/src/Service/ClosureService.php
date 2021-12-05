<?php
declare(strict_types=1);

namespace CuePhp\DI\Service;

use Closure;

class ClosureService implements ServiceInterface
{

    /**
     * @var Closure
     */
    private $_closure;

    private $_resolveAsSington;

    public function __construct(Closure $fn, bool $resolveAsSington)
    {
        $this->_closure = $fn;
        $this->_resolveAsSington = $resolveAsSington;
    }

    public function getClosure(): Closure
    {
        return $this->_closure;
    }

    public function resolveAsSingleton(): bool
    {
        return $this->_resolveAsSington;
    }
}
