<?php

declare(strict_types=1);

namespace CuePhp\Test\Config;

use PHPUnit\Framework\TestCase;
use CuePhp\Config\Config;
use CuePhp\Config\Loader\File\JsonLoader;
use CuePhp\Config\Loader\File\PhpLoader;

class ConfigRepositoryTest extends TestCase
{
    /**
     * @var ConfigInterface
     */
    protected $config;

    protected function setUp(): void
    {
        $this->config = new Config(__DIR__ . '/mocks/pass/config.php', new PhpLoader());
    }

    protected function tearDown(): void
    {
    }

    public function testGet()
    {
        $data = [
            'section' => 1
        ];
        $this->assertSame($data, $this->config->get('demo'));
    }

    public function testGetWithDefaultValue()
    {
        $this->assertSame(5, $this->config->get('demo.new', 5));
    }

    public function testGetNestedKey()
    {
        $this->assertSame(1, $this->config->get('demo.section'));
    }

    public function testGetNoneExistKey()
    {
        $this->assertNull($this->config->get('miss'));
    }

    public function testHas()
    {
        $this->assertTrue($this->config->has('demo'));
        $this->assertFalse($this->config->has('miss'));
    }

    public function testHasNestedKey()
    {
        $this->assertTrue($this->config->has('demo.section'));
    }

    public function testAll()
    {
        $all = [
            'demo' => [
                'section' => 1
            ]
        ];
        $this->assertSame($all, $this->config->all());
    }

    public function testMerge()
    {
        $otherConfig = new Config(__DIR__ . '/mocks/pass/config.json', new JsonLoader());
        $this->config->merge($otherConfig);
        $this->assertSame(1, $this->config->get('demo.section'));
    }

    public function testOffsetGet()
    {
        $this->assertSame(1, $this->config['demo.section']);
    }
}
