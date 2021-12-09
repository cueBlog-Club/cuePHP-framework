<?php

declare(strict_types=1);

namespace CuePhp\Config;

use ArrayAccess;
use CuePhp\Config\ConfigInterface;

use function array_key_exists;
use function array_replace_recursive;

abstract class ConfigRepository implements ArrayAccess, ConfigInterface
{
    /**
     * @var array
     */
    protected $data = [];

    protected $cache = null;

    public function __construct(array $data)
    {
        $this->data = array_merge($this->getDefaults(), $data);
    }

    abstract protected function getDefaults(): array;

    public function get(string $key, $default = null)
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        }
        return $default;
    }

    public function set(string $key, $value)
    {
        //TODO
        return;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function has(string $key): bool
    {
        if (isset($this->cache[$key])) {
            return true;
        }
        $segments = explode(".", $key);
        $root = $this->data;

        foreach ($segments as $segment) {
            if (array_key_exists($segment, $root)) {
                $root = $root[$segment];
                continue;
            } else {
                return false;
            }
        }

        $this->cache[$key] = $root;
        return true;
    }

    public function merge(ConfigInterface $config): ConfigInterface
    {
        $this->data = array_replace_recursive($this->data, $config->all());
        return $this;
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet( $offset,  $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetUnset( $offset): void
    {
        $this->set($offset, null);
    }
}
