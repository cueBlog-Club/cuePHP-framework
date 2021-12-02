<?php

declare(strict_types=1);

namespace CuePhp\Session;

use CuePhp\Session\Exception\MismatchException;
use CuePhp\Session\Handler\CacheSessionHandler;
use CuePhp\Session\Handler\FileSessionHandler;
use SessionHandlerInterface;
use CuePhp\Session\Session;
use Symfony\Component\Filesystem\Filesystem;

final class SessionManager
{

    const DEFAULT_HANDLER_NAME = FileSessionHandler::HANDLER_TYPE;

    public function __construct()
    {
    }

    /**
     * @return Session
     * @throws MismatchException
     */
    public function buildSession(): Session
    {
        $handler = $this->getHanlder();
        if ($handler === FileSessionHandler::HANDLER_TYPE) {
            return $this->createFileHandler();
        } elseif ($handler === CacheSessionHandler::HANDLER_TYPE) {
            return $this->createCacheHandler();
        } else {
            throw new MismatchException(
                `handler ${handler} is not implement`
            );
    }
}

    /**
     * TODO
     */
protected function createFileHandler(): Session
{
    return $this->createSession(
        new FileSessionHandler(new Filesystem(), getenv('SESSION_FILE'), (int)getenv('SESSION_TTL'))
    );
}

    /**
     * TODO
     */
protected function createCacheHandler(): Session
{
    return $this->createSession(
        new CacheSessionHandler(null, (int)getenv('SESSION_TTL'))
    );
}

    /**
     * create a new session instance
     * @var SessionHandlerInterface $handler
     * @return Session
     */
protected function createSession(SessionHandlerInterface $handler): Session
{
    return new Session($handler);
}

    /**
     * @return string
     */
private function getHanlder(): string
{
    return getenv("SESSION_HANDLER") ?? self::DEFAULT_HANDLER_NAME;
}


}
