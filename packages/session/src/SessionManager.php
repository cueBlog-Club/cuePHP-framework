<?php

declare(strict_types=1);

namespace CuePhp\Session;

use CuePhp\Session\Config\SessionConfig;
use CuePhp\Session\Exception\MismatchException;
use CuePhp\Session\Exception\StartFatalException;
use CuePhp\Session\Handler\SaveHandlerInterface;
use CuePhp\Session\SessionInterface;

use const PHP_SESSION_ACTIVE;
use function session_set_save_handler;

final class SessionManager
{

    /**
     * @var SessionConfig
     */
    private $_config;

    public function __construct(  SessionConfig $config  )
    {
        $this->config = $config;
    }

    /**
     * @return Session
     * @throws MismatchException
     */
    public function buildSession(): SessionInterface
    {
        if( (int)session_status() === PHP_SESSION_ACTIVE ) {
            throw new StartFatalException( 'session already started' );
        }
        $handler = $this->_config->getHandler();
        if( $handler instanceof SaveHandlerInterface  ) {
            throw new StartFatalException(`handler is missing`);
        }
        session_set_save_handler($handler, true);
        return new Session();
    }
}
