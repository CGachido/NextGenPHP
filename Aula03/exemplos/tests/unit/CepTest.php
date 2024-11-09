<?php

use App\ValueObject\Cep;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Cep::class)]
class CepTest extends TestCase
{
    public static function cepPositiveDataProvider()
    {
        return [
            ['12345-070', '12345-070'],
            ['13424-709', '13424-709']
        ];
    }

    #[DataProvider('cepPositiveDataProvider')]
    public function testClassCepShouldAcceptAValidCep(string $cepValue, string $expected): void
    {
        $cep = new Cep($cepValue);
        $this->assertEquals($expected, $cep->getValue());
    }

    public static function cepNegativeDataProvider()
    {
        return [
            ['13424-70'],
            ['1342-709'],
            ['1342470'],
        ];
    }

    #[DataProvider('cepNegativeDataProvider')]
    public function testClassCepShouldThrowValueException(string $cepValue): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cep inválido");
        $cep = new Cep($cepValue);
    }
}
