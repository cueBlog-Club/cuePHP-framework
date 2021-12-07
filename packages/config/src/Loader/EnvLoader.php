<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\LoaderInterface;

class EnvLoader implements LoaderInterface
{
    public function has(string $key): bool
    {
        $data = getenv($key);
        if ($data === false) {
            return false;
        }
        return true;
    }

    public function load(string $key)
    {
        if ($this->has($$key) === false) {
            throw new LoaderException(`config is not exist`);
        }
        return getenv($key);
    }
}
