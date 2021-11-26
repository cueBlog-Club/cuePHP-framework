<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer;
use Closure;

interface EngineerImpl
{

    /**
     * insert path into rules engineer
     */
    public function insert( string $route, Closure $func);

    /**
     * search path by rules
     */
    public function search(string $path);
}
