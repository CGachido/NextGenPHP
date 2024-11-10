I<?php

    use DifferDev\IsEven;
    use PHPUnit\Framework\Attributes\CoversClass;
    use PHPUnit\Framework\Attributes\DataProvider;
    use PHPUnit\Framework\TestCase;

    #[CoversClass(IsEven::class)]
    final class IsEvenTest extends TestCase
    {
        public static function isEvenPositiveDataProvider(): array
        {
            return [
                ['-2'],
                ['-4'],
                ['0'],
                ['2'],
                ['4']
            ];
        }

        #[DataProvider('isEvenPositiveDataProvider')]
        public function testClassShouldValidateisEven(string $number): void
        {
            $result = (new IsEven())->validate($number);
            $this->assertTrue($result);
        }

        public static function isEvenNegativeDataProvider(): array
        {
            return [
                ['-3'],
                ['-1'],
                ['1'],
                ['3']
            ];
        }

        #[DataProvider('isEvenNegativeDataProvider')]
        public function testClassShouldNotValidateIsNotEven(string $number): void
        {
            $result = (new IsEven())->validate($number);
            $this->assertFalse($result);
        }

        public static function isEvenInvalidArgumentDataProvider(): array
        {
            return [
                ['-0.99'],
                ['abc'],
            ];
        }

        #[DataProvider('isEvenInvalidArgumentDataProvider')]
        public function testClassShouldNotAcceptInvalidIntegerNumber(string $number): void
        {
            $this->expectException(InvalidArgumentException::class);
            (new IsEven())->validate($number);
        }
    }
