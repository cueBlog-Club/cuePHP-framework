<?php

declare(strict_types=1);

namespace CuePhp\Session\Handler;

use CuePhp\Cache\Engine\FileEngine;
use CuePhp\Session\Handler\SaveHandlerInterface;

class FileSessionHandler implements SaveHandlerInterface
{

    /**
     * @var FileEngine
     */
    private $_file = null;

    /**
     * session ttl
     * @var int
     */
    private $_minutes;

    public function __construct(FileEngine $file, int $minutes)
    {
        $this->_file = $file;
        $this->_minutes = $minutes;
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
        return $this->_file->get($sessionId);
    }

    public function write($sessionId, $data)
    {
        return $this->_file->set( $sessionId, $data, $this->_minutes * 60 );
    }

    public function destroy($sessionId)
    {
        return $this->_file->delete( $sessionId );
    }

    public function gc($lifetime)
    {
        // $files = Finder::create()
        //     ->in($this->path)
        //     ->files()
        //     ->ignoreDotFiles(true)
        //     ->date('<= now - ' . $lifetime . ' seconds');

        // foreach ($files as $file) {
        //     unlink($file->getRealPath());
        // }
        return true;
    }

    public function getAlias(): string
    {
        return 'file';
    }
}
