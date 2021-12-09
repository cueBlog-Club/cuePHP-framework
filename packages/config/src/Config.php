<?php

declare(strict_types=1);

namespace CuePhp\Config;

use CuePhp\Config\ConfigRepository;
use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\File\FileLoaderInterface;

class Config extends ConfigRepository
{


    public function __construct($values, $parser = null)
    {
        $this->loadFromFile($values, $parser);
        parent::__construct($this->data);
    }

    public static function load($values, $parser = null)
    {
        return new static($values, $parser);
    }

    protected function getDefaults(): array
    {
        return [];
    }

    protected function loadFromFile(string $path, FileLoaderInterface $loader = null)
    {
        if ($loader === null) {
            throw new LoaderException('loader handler not be missing');
        } else {
            $this->data = array_replace_recursive($this->data, $loader->loadFromFile($path));
        }
    }
}
