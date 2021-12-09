<?php
declare(strict_types=1);

namespace CuePhp\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\LoaderInterface;

interface FileLoaderInterface extends LoaderInterface
{
    /**
     * @param string $filename
     * @throws LoaderException
     */
    public function loadFromFile(string $filename): array;
}
