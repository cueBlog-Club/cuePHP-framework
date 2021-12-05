<?php
declare(strict_types=1);

namespace CuePhp\DI\Service;

use CuePhp\DI\Service\ServiceInterface;
use CuePhp\DI\Service\Context\AbstractContext;
use CuePhp\DI\Service\Context\ContextTrait;

trait ServiceTrait
{
    use ContextTrait;
    /**
     * @var array
     */
    protected $services = [];

    /**
     * @var AbstractContext
     */
    protected $ctx;

    /**
     * @var string $alias
     * @var ServiceInterface $service
     */
    public function addService(string $alias, ServiceInterface $service)
    {
        $target = $this->ctx->getTargetClass() ?? '';

        if (!isset($this->services[$target])) {
            $this->services[$target] = [];
        }
        $this->services[$target][$alias] = $service;
    }

    /**
     * @var string $alias
     * @return ServiceInterface|null
     */
    public function getService(string $alias): ?ServiceInterface
    {
        $targetClass = '';
        if ($this->ctx->getIsTargeted()) {
            $targetClass = $this->ctx->getTargetClass();
        }
        $service = $this->services[$targetClass][$alias] ?? null;
        return $service;
    }

    /**
     * @var string $alias
     */
    public function deleteService(string $alias)
    {
        $class = $this->ctx->getTargetClass() ?? '';
        unset($this->services[$class][$alias]);
    }

    /**
     * @var string $alias
     * @return bool
     */
    public function hasService(string $alias): bool
    {
        if ($this->ctx->getIsTargeted() && $this->hasTargetService($alias, $this->ctx->getTargetClass())) {
            return true;
        }
        return $this->hasTargetService($alias);
    }

    protected function hasTargetService(string $alias, string $target = null): bool
    {
        return isset($this->services[$target][$alias]);
    }
}
