<?php

declare(strict_types=1);

namespace CuePhp\Session\Handler;

use SessionHandlerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileSessionHandler implements SessionHandlerInterface
{

    const HANDLER_TYPE = 'file';

    protected $files;
    protected $path;

    /**
     *
     * @var int
     */
    protected $minutes;

    public function __construct(Filesystem $files, $path, $minutes)
    {
        $this->path = $path;
        $this->files = $files;
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
        if (is_file($path = $this->path . '/' . $sessionId)) {
            //TODO
            return file_get_contents($path);
        }
        return '';
    }

    public function write($sessionId, $data)
    {
        return $this->files->dumpFile($this->path . '/' . $sessionId, $data);
    }

    public function destroy($sessionId)
    {
        unlink($this->path . '/' . $sessionId);
        return true;
    }

    public function gc($lifetime)
    {
        $files = Finder::create()
            ->in($this->path)
            ->files()
            ->ignoreDotFiles(true)
            ->date('<= now - ' . $lifetime . ' seconds');

        foreach ($files as $file) {
            unlink($file->getRealPath());
        }
        return true;
    }
}
