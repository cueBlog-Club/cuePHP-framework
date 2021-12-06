<?php

declare(strict_types=1);

namespace CuePhp\Session;

use CuePhp\Session\SessionInterface;
use function session_start;
use function session_destroy;
use function session_unset;

class Session
{

    /**
     * @var string
     */
    private $_id;


    /**
     * 
     */
    public function __construct( string $id = '' )
    {
        $this->_id = $id;
        $this->_init();
    }

    public function start()
    {
        session_start();
    }

    /**
     * @var string $key
     * @var mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * @var string $key
     * @var mixed $value
     * @return $this
     */
    public function set(string $key, $value): Session
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    /**
     * @var string $key
     * @return bool
     */
    public function exist(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * get all values in $_SESSION
     * @return array
     */
    public function all(): array
    {
        return $_SESSION;
    }

    /**
     * delete one Item
     * @return bool
     */
    public function remove(string $key)
    {
        unset($_SESSION[$key]);
        return true;
    }

    /**
     * delete all items
     * @return bool
     */
    public function clear(): bool
    {
        session_unset();
        session_destroy();
        return true;
    }

    private function _init()
    {
        ini_set('session.cookie_path', '/');
        // ini_set('session.cookie_domain', '.mydomain.com');
        // ini_set('session.cookie_lifetime', '1800');
    }
}
