<?php
declare(strict_types=1);

namespace CuePhp\DI\Service\Resolver;

interface ResolverInterface
{
    public function resolve(): object;
}
