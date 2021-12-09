<?php

declare(strict_types=1);

namespace CuePhp\Test\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use PHPUnit\Framework\TestCase;
use CuePhp\Config\Loader\File\YamlLoader;

class YamlLoaderTest extends TestCase
{
    /**
     * @var YamlLoader
     */
    protected $yml;

    protected function setUp(): void
    {
        $this->yml = new YamlLoader();
    }

    protected function tearDown(): void
    {
    }

    public function testLoadInvalidYml()
    {
        $this->expectException(LoaderException::class);
        $this->yml->loadFromFile( __DIR__. '/../../mocks/fail/error.yml' );
    }

    public function testLoadYml()
    {
        $data = $this->yml->loadFromFile( __DIR__. '/../../mocks/pass/config.yml' );
        $this->assertSame( 1, $data['demo']['section']  );

    }
}
