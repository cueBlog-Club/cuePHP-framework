<?php
declare(strict_types=1);

namespace CuePhp\Cache;

use PHPUnit\Framework\TestCase;
use CuePhp\Cache\Utils\Str;

class StrTest extends TestCase 
{
    public function testEndsWith()
    {
        $result = Str::endsWith( 'key.do', 'ddo' );
        $this->assertSame(false, $result);

        $result = Str::endsWith( 'key.do', 'do' );
        $this->assertSame(true, $result);
    }
}