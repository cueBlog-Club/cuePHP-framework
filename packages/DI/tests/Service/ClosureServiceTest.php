<?php

declare(strict_types=1);

namespace CuePhp\Test\DI\Service;

use Closure;
use PHPUnit\Framework\TestCase;
use CuePhp\DI\Service\ClosureService;

class ClosureServiceTest extends TestCase
{

    public function testGetResolveAsSingleton()
    {
        $func = function(){ return $this; };
        $service = new ClosureService($func, false);
        $this->assertFalse( $service->resolveAsSingleton() );
        $service = new ClosureService($func, true);
        $this->assertTrue( $service->resolveAsSingleton() );
    }


    public function testGetClosure()
    {
        $fn = function(){ return $this; };
        $service = new ClosureService($fn, true);
        $this->assertSame( $fn, $service->getClosure() );
    }

}