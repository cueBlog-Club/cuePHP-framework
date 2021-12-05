<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\InstanceService;
use stdClass;

class InstanceServiceTest extends TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testGetResolveAsSingleton()
    {
        $service = new InstanceService(new stdClass());
        $this->assertTrue($service->resolveAsSingleton());
    }

    public function testGetPrimitives()
    {
        $instance = new stdClass();
        $service = new InstanceService($instance);
        $this->assertSame($instance, $service->getInstance());
    }
}
