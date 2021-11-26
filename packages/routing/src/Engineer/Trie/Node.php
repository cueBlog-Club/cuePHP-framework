<?php

declare(strict_types=1);

namespace CuePhp\Routing\Engineer\Trie;

/**
 * 
 */
class Node
{
    /**
     * url pattern : like /p/:path
     * @var string
     */
    public $pattern = "";

    /**
     * url splited parts: llike "p", ":path"
     * @var string
     */
    public $part = "";

    /**
     * children node
     * @var Node[]
     */
    public $childs = [];

    /**
     * include "*" or ":"  is false 
     * @var bool
     */
    public $wildcard = true;

    public function __toString(): string
    {
        return sprintf("node{pattern=%,part=%,wildcard=t}", $this->pattern, $this->part, $this->wildcard);
    }

    /**
     * match one child
     * @var string $part
     * @return Node | null
     */
    public  function  matchChild(string $part): ?Node
    {
        foreach ($this->childs as $child) {
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
        foreach ($this->childs as $child) {
            if ($child->part === $part || $child->wildcard) {
                $nodes[] = $child;
            }
        }
        return $nodes;
    }

    /**
     *  insert  new Node
     * @var string pattern
     * @var array<string> $parts
     * @var int $height
     * @return void
     */
    public function insert(string $pattern, array $parts, int $height): void
    {
        if (count($parts) === $height) {
            $this->pattern = $pattern;
            return;
        }
        $part = $parts[$height];
        $child = $this->matchChild($part);
        if ($child == null) {
            $child = new Node();
            $child->part = $part;
            $child->wildcard = $part[0] === ":" || $part[0] === "*";
            $this->childs[] = $child;
        }
        $child->insert($pattern, $parts, $height + 1);
    }

    /**
     * search matched node
     * @var array<string> $parts
     * @var int $height
     * @return Node|null
     */
    public function search(array $parts, int $height): ?Node
    {
        if(count($parts) === $height) {
            if( $this->pattern === "" ) {
                return null;
            }
            return $this;
        }
        $part = $parts[$height];
        $children = $this->matchChildren($part);

        foreach ($children as $child) {
            $result = $child->search( $parts, $height+1 );
            if( $result !== null ) {
                return $result;
            }
        }

        return null;
    }
}
