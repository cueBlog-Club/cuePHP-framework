<?php
declare(strict_types=1);

namespace CuePhp\Session\Handler;

use Illuminate\Contracts\Cache\Repository as CacheContract;
use SessionHandlerInterface;

class CacheSessionHandler implements SessionHandlerInterface
{

    const HANDLER_TYPE = 'cache';
    /**
     * @var CacheContract
     */
    protected $cache;

    /**
     *
     * @var int
     */
    protected $minutes;

    /**
     *
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     * @param  int  $minutes
     * @return void
     */
    public function __construct(?CacheContract $cache, $minutes)
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
        return $this->cache->put($sessionId, $data, $this->minutes * 60);
    }

    public function destroy($sessionId)
    {
        return $this->cache->forget($sessionId);
    }

    public function gc($lifetime)
    {
        return true;
    }
}
