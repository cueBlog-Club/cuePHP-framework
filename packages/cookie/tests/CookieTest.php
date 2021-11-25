<?php
declare(strict_types=1);

namespace CuePhp\Test\Cookie;

use PHPUnit\Framework\TestCase;
use CuePhp\Cookie\Cookie;

final class CookieTest extends TestCase
{
    public function testAccess(): void
    {
        $cookie = new Cookie(
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

    public function testCreate(): void
    {
        $cookie = Cookie::create(
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

    public function testToHeadersString(): void
    {
        $cookie = new Cookie(
            'test',
            'value',
            [
                'expires' => 100,
                'path' => '/',
                'domain' => 'www.test.com',
                'secure' => true,
                'httponly' => true
            ]
            );
            $this->assertStringContainsString(
                'test=value',
                $cookie->toHeadersString()
            );
     
            $this->assertStringContainsString(
                'expires=100;path=/;domain=www.test.com;secure;httponly',
                $cookie->toHeadersString()
            );

    }

}