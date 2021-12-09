<?php

declare(strict_types=1);

namespace CuePhp\Config;

trait ConfigTrait
{

    /**
     * @var ConfigInterface
     */
    public $config;

    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}
