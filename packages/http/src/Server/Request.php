<?php

declare(strict_types=1);

namespace CuePhp\Http\Server;



class Request 
{
    /**
     * @var array
     */
    private $_request = [];

    public function __construct( array $data )
    {
        $this->_request = $data;
    }

    public function getData()
    {
        return $this->_request;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exist(string $key): bool
    {
        return isset( $this->_request[$key] );
    }

    public function get($key, $default = null)
    {
        return $this->exist($key) ? $this->_request[$key] : $default;
    }

}