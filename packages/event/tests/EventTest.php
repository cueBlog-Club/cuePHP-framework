<?php
declare(strict_types=1);

namespace CuePhp\Event;

use PHPUnit\Framework\TestCase;

class EventTest extends TestCase 
{

    protected function setUp(): void
    {
        
    }

    public function testAccess()
    {
        $event  = new Event('event');
        $this->assertFalse( $event->isPropagationStopped() );
    }

    public function testStopPropagation()
    {
        $event  = new Event('event');
        $event->stopPropagation();
        $this->assertTrue( $event->isPropagationStopped() );
    }

}