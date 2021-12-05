<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\ClassService;

class ClassServiceTest extends TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testGetResolveAsSingleton()
    {
        $service = new ClassService(self::class, [], false);
        $this->assertFalse($service->resolveAsSingleton());
        $service = new ClassService(self::class, [], true);
        $this->assertTrue($service->resolveAsSingleton());
    }

    public function testGetClass()
    {
        $service = new ClassService(self::class, [], false);
        $this->assertSame(self::class, $service->getClass());
    }

    public function testGetPrimitives()
    {
        $service = new ClassService(self::class, ['test'], false);
        $this->assertSame(['test'], $service->getPrimitives());
    }
}
