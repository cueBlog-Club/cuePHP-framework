<?php

declare(strict_types=1);

namespace CuePhp\Config;

interface ConfigInterface
{
    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;


    /**
     * Get all Configuration Items
     * @return array
     */
    public function all(): array;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value);

    /**
     * @param string $Key
     * @param array|string|null $default
     * @return array|string
     */
    public function get(string $key, $default = null);
}
