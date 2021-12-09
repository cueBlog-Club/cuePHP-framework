<?php

declare(strict_types=1);

namespace CuePhp\Test\Config\Loader\File;

use CuePhp\Config\Exception\LoaderException;
use PHPUnit\Framework\TestCase;
use CuePhp\Config\Loader\File\JsonLoader;

class JsonLoaderTest extends TestCase
{

    /**
     * @var JsonLoader
     */
    protected $json;

    protected function setUp(): void
    {
        $this->json = new JsonLoader();
    }

    protected function tearDown(): void
    {
    }

    public function testLoadInvalidJson()
    {
        $this->expectException(LoaderException::class);
        $this->json->loadFromFile( __DIR__. '/../../mocks/fail/error.json' );
    }

    public function testLoadJson()
    {
        $data = $this->json->loadFromFile( __DIR__. '/../../mocks/pass/config.json' );
        $this->assertSame( 1, $data['demo']['section']  );

    }

   
}
