<?php
declare(strict_types=1);

namespace CuePhp\Config\Loader;

use CuePhp\Config\Exception\LoaderException;

interface LoaderInterface
{
    /**
     * @param array|null $data
     * @throws LoaderException
     */
    public function load(?array $data): array;
}
