<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\Context\TargetedContext;

class TargetContextTest extends TestCase
{
    protected function setUp(): void
    {
        
    }

    protected function tearDown(): void
    {
        
    }

    public function testAccess()
    {
        $ctx = new TargetedContext(self::class);
        $this->assertSame(self::class, $ctx->getTargetClass());
        $this->assertTrue( $ctx->getIsTargeted());
        $this->assertFalse($ctx->getIsGlobal());
    }
}