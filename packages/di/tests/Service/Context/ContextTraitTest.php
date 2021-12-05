<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\Context\ContextTrait;

class ContextTraitTest extends TestCase
{
    protected function setUp(): void
    {
        
    }

    protected function tearDown(): void
    {
        
    }

    public function testInitContext()
    {
        $mock = $this->getMockForTrait(ContextTrait::class);
        // $mock->expects($this->any())->method('initContext')->will($this->returnValue(TRUE));
        $mock->initContext();
        $this->assertTrue($mock->ctx->getIsGlobal() && !$mock->ctx->getIsTargeted());
    }

}