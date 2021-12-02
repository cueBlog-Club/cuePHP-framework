<?php

declare(strict_types=1);

namespace CuePhp\Routing\Utils;

final class Str
{

    /**
     * split url pattern to parts
     * @var string $pattern
     * @return array<string>
     */
    public static function parsePattern(string $pattern): array
    {
        $parts = [];
        foreach (explode("/", $pattern) as  $part) {
            if ($part === "") {
                continue;
            }
            $parts[] = $part;
            if ($part[0] === "*") {
                break;
            }
        }
        return $parts;
    }


    /**
     * generate route key
     * @param string $method
     * @param string $uri-path
     * @return string
     */
    public static function buildRouteKey(string $method, string $uri): string
    {
        return $method . '-' . $uri;
    }
}
