<?php

declare(strict_types=1);

namespace CuePhp\DI\Service\Context;

abstract class AbstractContext
{

    /**
     * @var string
     */
    protected $targetClass = "";

    /**
     * @var bool
     */
    protected $isTargeted = false;

    /**
     * @var bool
     */
    protected $isGlobal = false;

    protected function __construct(string $class = '', bool $isTargeted = false, bool $isGlobal = false)
    {
        $this->targetClass = $class;
        $this->isTargeted = $isTargeted;
        $this->isGlobal = $isGlobal;
    }

    public function getTargetClass(): string
    {
        return $this->targetClass;
    }

    public function getIsTargeted(): bool
    {
        return $this->isTargeted;
    }

    public function getIsGlobal(): bool
    {
        return $this->isGlobal;
    }
}
