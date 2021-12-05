<?php

declare(strict_types=1);

namespace CuePhp\Session\Config;

use CuePhp\Session\Exception\MismatchException;
use CuePhp\Session\Handler\SaveHandlerInterface;

class SessionConfig
{

    /**
     * @var string
     */
    private $_handlerAlias = '';

    /**
     * @var int
     */
    private $_ttl = 5 * 86400;

    /**
     * @return SaveHandlerInterface
     * @throws MismatchException
     */
    public function getHandler(): SaveHandlerInterface
    {
        if( $this->_handlerAlias === '' ) {
            throw new MismatchException(`handler must be not empty`);
        }
        if( class_exists( $this->_handlerAlias ) ) {
            return new $this->_handlerAlias;
        }
        throw new MismatchException(sprintf('%s is not implenment ', $this->_handlerAlias));
        
        return $this->_handler;
    }

    public function getHandlerAlias(): string
    {
        return $this->_handlerAlias;
    }

    public function setHandlerAlias(string $alias)
    {
        $this->_handlerAlias = $alias;
    }

    public function getTTL(): int
    {
        return $this->_ttl;
    }

    public function setTTL(int $ttl)
    {
        $this->_ttl = $ttl;
    }
}
