<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer;

use CuePhp\Routing\Engineer\Trie\Node;
use CuePhp\Routing\Utils\Str;
use Closure;

/**
 * 
 */
class TrieEngineer implements EngineerImpl
{
    use EngineerTrait;
    /**
     * insert path into rules engineer
     */
    public function insert( string $route)
    {
      
    }

    /**
     * search path by rules
     */
    public function search(string $path)
    {
        //TODO
    }
}
