<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer;

interface EngineerInterface
{

    /**
     * insert path into rules engineer
     */
    public function insert( string $route);

    /**
     * search path by rules
     */
    public function search(string $path);
}
