<?php
declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;

class PhpLoader implements LoaderInterface
{
    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return true;
    }

    /**
     * @param string $key
     * @return array
     * @throws  LoaderException
     */
    public function load(string $key )
    {
        
    }

}