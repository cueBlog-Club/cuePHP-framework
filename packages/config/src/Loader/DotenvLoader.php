<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;
use Dotenv\Dotenv;

final class DotenvLoader extends EnvLoader
{

    public function load(?array $data): array
    {
        // load .env to environment
        $env = Dotenv::createImmutable(__DIR__);
        $env->load();
        return parent::load(null);
    }
}
