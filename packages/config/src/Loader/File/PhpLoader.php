<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\File\FileLoaderInterface;
use Exception;

class PhpLoader implements FileLoaderInterface
{
    public function loadFromFile(string $filename): array
    {
        try {
            $data = require $filename;
        } catch (Exception $e) {
            throw new LoaderException('PHP file syntax error');
        }
        return (array)$this->load($data);
    }

    public function load(?array $data): array
    {
        if (!is_array($data)) {
            throw new LoaderException("PHP data does not return an array");
        }
        return $data;
    }
}
