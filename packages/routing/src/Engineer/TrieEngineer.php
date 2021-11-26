<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer;

use Cuephp\Routing\Engineer\Trie\Node;
use Cuephp\Routing\Utils\Str;
use Closure;

/**
 * 
 */
class TrieEngineer implements EngineerImpl
{
    /**
     * http method
     * @var string
     */
    private $_method = "";

    /**
     * trie tree head node
     * @var Node
     */
    private $_head = null;


    /**
     * insert path into rules engineer
     */
    public function insert( string $route, Closure $func)
    {
        $parts = Str::parsePattern( $route );
        $this->_head->insert( $route, $parts, 0 );
    }

    /**
     * search path by rules
     */
    public function search(string $path)
    {
        //TODO
    }
}
