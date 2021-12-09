<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\File\FileLoaderInterface;

use function file_get_contents;
use function json_last_error_msg;

use const JSON_ERROR_NONE;

class JsonLoader implements FileLoaderInterface
{
    public function loadFromFile(string $filename): array
    {
        $data = json_decode(file_get_contents($filename), true);
        return (array) $this->load($data);
    }

    public function load(?array $data): array
    {
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errMsg = json_last_error_msg();
            throw new LoaderException($errMsg);
        }
        return $data;
    }
}
