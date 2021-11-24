<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer;

interface EngineerImpl
{

    /**
     * insert path into rules engineer
     */
    public function insert(string $path);

    /**
     * search path by rules
     */
    public function search(string $path);
}
