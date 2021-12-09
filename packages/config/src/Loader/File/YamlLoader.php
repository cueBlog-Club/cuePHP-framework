<?php

declare(strict_types=1);

namespace CuePhp\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\File\FileLoaderInterface;
use Symfony\Component\Yaml\Yaml;

use Exception;

class YamlLoader implements FileLoaderInterface
{
    public function loadFromFile(string $filename): array
    {
        try {
            $data = Yaml::parseFile($filename, Yaml::PARSE_CONSTANT);
        } catch (Exception $e) {
            throw new LoaderException($e->getMessage());
        }
        return (array) $this->load($data);
    }

    public function load(?array $data): array
    {
        return $data;
    }
}
