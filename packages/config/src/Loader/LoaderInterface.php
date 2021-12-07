<?php
declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;

interface LoaderInterface
{
    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @return array|string
     * @throws  LoaderException
     */
    public function load(string $key );

}