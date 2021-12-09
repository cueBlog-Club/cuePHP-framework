<?php

declare(strict_types=1);

namespace CuePhp\Test\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use PHPUnit\Framework\TestCase;
use CuePhp\Config\Loader\File\PhpLoader;

class PhpLoaderTest extends TestCase
{

    /**
     * @var PhpLoader
     */
    protected $php;

    protected function setUp(): void
    {
        $this->php = new PhpLoader();
    }

    protected function tearDown(): void
    {
    }

    public function testLoadInvalidPhpFile()
    {
        $this->expectException(LoaderException::class);
        $this->php->loadFromFile( __DIR__. '/../../mocks/fail/error.php' );
    }

    public function testLoadPhp()
    {
        $data = $this->php->loadFromFile( __DIR__. '/../../mocks/pass/config.php' );
        $this->assertSame( 1, $data['demo']['section']  );

    }
    
}
