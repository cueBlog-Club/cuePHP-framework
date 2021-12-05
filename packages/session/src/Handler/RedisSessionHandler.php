<?php
declare(strict_types=1);

namespace CuePhp\Session\Handler;

use CuePhp\Cache\Engine\RedisEngine;
use CuePhp\Session\Handler\SaveHandlerInterface;

class CacheSessionHandler implements SaveHandlerInterface
{

    /**
     * @var RedisEngine
     */
    protected $cache;

    /**
     *
     * @var int
     */
    protected $minutes;

    /**
     *
     * @param RedisEngine  $cache
     * @param  int  $minutes
     * @return void
     */
    public function __construct(RedisEngine $cache, $minutes)
    {
        $this->cache = $cache;
        $this->minutes = $minutes;
    }

    public function open($savePath, $sessionName)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($sessionId)
    {
        return $this->cache->get($sessionId, '');
    }

    public function write($sessionId, $data)
    {
        return $this->cache->set($sessionId, $data, $this->minutes * 60);
    }

    public function destroy($sessionId)
    {
        return $this->cache->delete($sessionId);
    }

    public function gc($lifetime)
    {
        return true;
    }

    public function getAlias(): string
    {
        return 'redis';
    }
}
