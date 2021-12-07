<?php
declare(strict_types=1);

namespace CuePhp\Config;

interface ConfigInterface
{
    public function has(string $key): bool;

    public function set(string $key, $path): array;

    public function setDefault(string $key, array $data);
}