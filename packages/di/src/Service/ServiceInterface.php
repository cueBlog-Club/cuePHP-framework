<?php
declare(strict_types=1);

namespace CuePhp\DI\Service;

interface ServiceInterface
{
    public function resolveAsSingleton(): bool;
}
