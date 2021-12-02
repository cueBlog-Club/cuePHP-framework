<?php

declare(strict_types=1);

namespace CuePhp\Routing\Engineer\Trie;

/**
 * 
 */
class Node
{

    /**
     * full path and save in the leave node
     * @var string
     */
    private $_pattern = "";

    /**
     * url splited parts: llike "p", ":path"
     * @var string
     */
    private $_part = "";

    /**
     * children node
     * @var Node[]
     */
    private  $_childs = [];

    /**
     * include "*" or ":"  is false 
     * @var bool
     */
    private $_wildcard = true;

    protected function __construct( string $part )
    {
        $this->_part = $part;
        $this->_wildcard = $part[0] === ":" || $part[0] === "*";
    }

    public static  function newNode(  string $part ): Node
    {
        return new self( $part );
    }

    public function getPart(): string
    {
        return $this->_part;
    }

    public function getWildcard(): bool 
    {
        return $this->_wildcard;
    }

    public function getPattern(): string
    {
        return $this->_pattern;
    }

    /**
     * @var string 
     */
    public function setPattern(  string $pattern )
    {
        $this->_pattern = $pattern;
    }

    /**
     * @var Node[]
     */
    public function getChilds(): array
    {
        return $this->_childs;
    }

    public function __toString(): string
    {
        return sprintf("node{part=%,wildcard=t}", $this->part, $this->wildcard);
    }

    public function addChild( Node $node )
    {
        $this->_childs[] = $node;
    }

        /**
     * match one child
     * @var string $part
     * @return Node | null
     */
    public  function  matchChild(string $part): ?Node
    {
        foreach ($this->_childs as $child) {
            if ($child->part === $part || $child->wildcard) {
                return $child;
            }
        }
        return null;
    }
    

    /**
     * match all children
     * @var strin $part
     * @return Node[]
     */
    public function matchChildren(string $part): array
    {
        $nodes = [];
        foreach ($this->_childs as $child) {
            if ($child->part === $part || $child->wildcard) {
                $nodes[] = $child;
            }
        }
        return $nodes;
    }
}
