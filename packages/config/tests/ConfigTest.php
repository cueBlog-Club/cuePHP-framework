<?php

declare(strict_types=1);

namespace CuePhp\Test\Config;

use PHPUnit\Framework\TestCase;
use CuePhp\Config\Config;
use CuePhp\Config\Exception\LoaderException;
use CuePhp\Config\Loader\File\JsonLoader;
use CuePhp\Config\Loader\File\PhpLoader;
use CuePhp\Config\Loader\File\YamlLoader;
use TypeError;

class ConfigTest extends TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    // TODO...
    // public function testConstructWithEmptyDir()
    // {
    //     $this->expectException(LoaderException::class);
    //     new Config(__DIR__ . '/mocks/empty', new PhpLoader());
    // }

    /**
     * @expectedException LoaderException
     */
    // public function testConstructWithInvalidPath()
    // {

    //     $this->expectException(LoaderException::class);
    //     new Config('invalidpath.php', new PhpLoader());
    // }

    // public function testConstructWithNoneExistFile()
    // {
    //     $this->expectException(LoaderException::class);
    //     new Config('invalidpath.php', new PhpLoader());
    // }

    public function testConstructWithYml()
    {
        $config = new Config(__DIR__ . '/mocks/pass/config.yml', new YamlLoader());
        $this->assertSame(1, $config->get('demo.section'));
        // TODO
        $this->expectException(TypeError::class);
        $config = new Config(__DIR__ . '/mocks/pass/empty.yml', new YamlLoader());
        $this->assertSame([], $config->all());
    }


    public function testConstructWithJson()
    {
        $config = new Config(__DIR__ . '/mocks/pass/config.json', new JsonLoader());
        $this->assertSame(1, $config->get('demo.section'));
        // TODO
        $this->expectException(LoaderException::class);
        $config = new Config(__DIR__ . '/mocks/pass/empty.json', new JsonLoader());
        $this->assertSame([], $config->all());
    }


    public function testConstructWithPhp()
    {
        $config = new Config(__DIR__ . '/mocks/pass/config.php', new PhpLoader());
        $this->assertSame(1, $config->get('demo.section'));
        // TODO
        $this->expectException(TypeError::class);
        $config = new Config(__DIR__ . '/mocks/pass/empty.php', new PhpLoader());
        $this->assertSame([], $config->all());
    }
}
