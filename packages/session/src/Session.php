<?php

declare(strict_types=1);

namespace CuePhp\Session;

use SessionHandlerInterface;

class Session
{
    /**
     * @var SessionHandlerInterface
     */
    protected $handler = null;

    /**
     * TODO single
     */
    public function __construct(SessionHandlerInterface $handler, $id = null)
    {
        $this->handler = $handler;
        $this->_init();
    }

    public function start()
    {
        session_start();
    }

    public function bind()
    {
        session_set_save_handler($this->handler, true);
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function exist(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function all(): array
    {
        return $_SESSION;
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
        return true;
    }

    public function clear()
    {
        return session_unset();
    }

    private function _init()
    {
        ini_set('session.cookie_path', '/');
        // ini_set('session.cookie_domain', '.mydomain.com');
        // ini_set('session.cookie_lifetime', '1800');
    }
}
