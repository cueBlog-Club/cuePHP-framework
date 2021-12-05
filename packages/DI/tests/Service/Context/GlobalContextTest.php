<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\Context\GlobalContext;

class GlobalContextTest extends TestCase
{
    protected function setUp(): void
    {
        
    }

    protected function tearDown(): void
    {
        
    }

    public function testAccess()
    {
        $ctx = new GlobalContext();
        $this->assertSame('', $ctx->getTargetClass());
        $this->assertFalse( $ctx->getIsTargeted());
        $this->assertTrue($ctx->getIsGlobal());
    }

}