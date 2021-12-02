<?php
declare(strict_types=1);

namespace CuePhp\Routing\Engineer\Trie;

use CuePhp\Routing\Engineer\Trie\Node;
use CuePhp\Routing\Utils\Str;

/**
 * 
 */
class Trie
{
    /**
     * trie tree root node
     * @var Node
     */
    private  $_root = null;

    protected function __construct( Node $root )
    {
        $this->_root = $root;
    }

    /**
     * creat a new trie tree
     */
    public static function newTrie(): Trie
    {
        $root = Node::newNode("/");
        return new self($root);
    }


    /**
     *  insert  a path
     * @var string pattern
     * @return void
     */
    public function insert( string $pattern ) : void
    {
        $parts =  Str::parsePattern( $pattern );
        $node = $this->_root;
        foreach( $parts as $part )
        {
            $child = $node->matchChild( $part );
            if( $child === null )
            {
                // create new node
                $child = Node::newNode( $part );
                $node->addChild( $child );
            }
            $node = $child;
        }
        $node->setPattern( $pattern );
    }

    /**
     * find $uri is in trie Tree
     * @var string $uri
     * @return Node|null 
     */
    public function search( string $uri ): ?Node
    {
        $node = $this->_root;
        $parts =  Str::parsePattern( $$uri );
        $n = count( $parts );
        foreach( $parts as $level => $part )
        {
            $children = $node->matchChildren( $part );
            if( count( $children ) === 0 )
            {
                return null;
            }
            $child = null;
            foreach( $children as $c )
            {
                if( $c->getWildcard() === false )
                {
                    $child = $c;
                    break;
                }
            }

            if( $child !== null && $level == $n-1  )
            {
                return $child;
            }
            $node = $child;
        }
        return null;
    }
   
}
