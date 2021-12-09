<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\LoaderInterface;

class EnvLoader implements LoaderInterface
{
    public function load(?array $data): array
    {
        return getenv();
    }
}
