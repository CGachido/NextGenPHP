<?php

use DifferDev\IsGreaterThan;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(IsGreaterThan::class)]
final class IsGreaterThanTest extends TestCase
{

    public static function isGreaterThanPositiveDataProvider(): array
    {
        return [
            ['300', '302'],
            ['1', '2'],
            ['301.98', '301.99'],
            ['-301.99', '-301.98'],
        ];
    }

    #[DataProvider('isGreaterThanPositiveDataProvider')]
    public  function testClassIsGreaterThanShoudValidateIsGreaterThan(string $number, string $comparer)
    {
        $validator = new IsGreaterThan($number);
        $result = $validator->validate($comparer);
        $this->assertTrue($result);
    }


    public static function isGreaterThanNegativeDataProvider(): array
    {
        return [
            ['301', '300'],
            ['2', '1'],
            ['301.99', '301.98',],
            ['-301.98', '-301.99'],
        ];
    }

    #[DataProvider('isGreaterThanNegativeDataProvider')]
    public  function testClassIsGreaterThanShoudNotValidateIsGreaterThan(string $number, string $comparer)
    {
        $validator = new IsGreaterThan($number);
        $result = $validator->validate($comparer);
        $this->assertFalse($result);
    }


    public function testClassIsGreaterThanNotAcceptInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        new IsGreaterThan('abc');
    }
}
