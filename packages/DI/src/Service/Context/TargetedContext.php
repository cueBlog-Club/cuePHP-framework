<?php
declare(strict_types=1);

namespace CuePhp\DI\Service\Context;

final class TargetedContext extends AbstractContext
{
    public function __construct(?string $class = null)
    {
        parent::__construct($class, true, false);
    }
}
