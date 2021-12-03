<?php
declare(strict_types=1);

namespace CuePhp\Test\Cookie;

use PHPUnit\Framework\TestCase;
use CuePhp\Cookie\CookieManager;
use CuePhp\Cookie\Cookie;

final class CookieManagerTest extends TestCase
{
    public function testNew(): void
    {
        $cookie = CookieManager::new(
            'test',
            'value',
            [
                'max-age' => 100,
                'path' => '/',
                'domain' => 'test.com',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]
            );

            $this->assertSame( 'test', $cookie->getName() );
            $this->assertSame( 'value', $cookie->getValue() );
            $this->assertSame( time()+100, $cookie->getExpire() );
            $this->assertSame( 'test.com', $cookie->getDomain() );
            $this->assertTrue( $cookie->getSecure() );
            $this->assertTrue(  $cookie->getHttpOnly() );
            $this->assertSame( 'Lax',  $cookie->getSamesite() );
    }

    public function testCreateFromHeaders(): void
    {
        $cookieString = "test=value;expires=100;path=/;domain=www.test.com;secure;httponly";
        $cookie = CookieManager::createFromHeaders($cookieString);
        $this->assertSame( 'test', $cookie->getName() );
        $this->assertSame( 'value', $cookie->getValue() );
        $this->assertSame( 100, $cookie->getExpire() );
        $this->assertSame( 'www.test.com', $cookie->getDomain() );
        $this->assertTrue( $cookie->getSecure() );
        $this->assertTrue(  $cookie->getHttpOnly() );
    }
}