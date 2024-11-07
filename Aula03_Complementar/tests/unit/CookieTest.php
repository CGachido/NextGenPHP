<?php

use Headers\Response\Cookie;
use PHPUnit\Framework\TestCase;

final class CookieTest extends TestCase
{
    public function positiveCookieDataProvider()
    {
        return [
            ['attribute', 'value', 'Set-Cookie: attribute=value'],
            ['mycookye', 'meu valor com espaço', 'Set-Cookie: mycookye=meu+valor+com+espa%C3%A7o'],
            ['complex', 'teste()/\\$#*&}}{_-', 'Set-Cookie: complex=teste%28%29%2F%5C%24%23%2A%26%7D%7D%7B_-'],
            ['  attribute  ', 'value', 'Set-Cookie: attribute=value'],
            ['attribute', '  value  ', 'Set-Cookie: attribute=value'],
        ];
    }

    /**
     * @dataProvider positiveCookieDataProvider
     */
    public function testCookieComponentShouldReturnCookieHeaderString(
        string $cookieName,
        string $cookieValue,
        string $expected
    ) {
        $cookie = new Cookie($cookieName, $cookieValue);
        $result = $cookie->getHeaderString();
        $this->assertEquals($expected, $result);
    }

    public function negativeCookieDataProvider()
    {
        return [
            ['aço', 'valor aqui', InvalidArgumentException::class],
            ['campo teste', 'valor aqui', InvalidArgumentException::class],
        ];
    }

    /**
     * @dataProvider negativeCookieDataProvider
     */
    public function testeCookieComponentShouldNotAcceptWrongName(
        string $cookieName,
        string $cookieValue,
        string $expected
    ) {
        $this->expectException($expected);
        new Cookie($cookieName, $cookieValue);
    }

    public function testCookieComponentShouldReturnValueUrlEncoded()
    {
        $cookie = new Cookie('attribute', 'a value with spaces');
        $result = $cookie->getHeaderString();
        $this->assertEquals('Set-Cookie: attribute=a+value+with+spaces', $result);
    }

    public function positiveCookieExpiresDataProvider()
    {
        return require 'fixture/DataProviders/positiveCookieExpires.php';
    }

    /**
     * @dataProvider positiveCookieExpiresDataProvider
     */
    public function testCookieComponentShouldReturnExpiresAttribute(
        string $cookieName,
        string $cookieValue,
        string $startDate,
        string $expireInterval,
        string $expected
    ) {
        $cookie = new Cookie(
            $cookieName,
            $cookieValue,
            new DateTimeImmutable($startDate)
        );
        $cookie->setExpires($expireInterval);
        $result = $cookie->getHeaderString();
        $this->assertEquals($expected, $result);
    }
}
