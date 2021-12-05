<?php

declare(strict_types=1);

namespace CuePhp\Cache\Utils;

class Str
{
     /**
      *
      */
    public static function endsWith(string $str, string $posfix): bool
    {
        return substr($str, strpos($str, $posfix)) === $posfix;
    }
}
