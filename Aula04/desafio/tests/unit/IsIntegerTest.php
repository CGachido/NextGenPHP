I<?php

    use DifferDev\IsInteger;
    use PHPUnit\Framework\Attributes\CoversClass;
    use PHPUnit\Framework\Attributes\DataProvider;
    use PHPUnit\Framework\TestCase;

    #[CoversClass(IsInteger::class)]
    final class IsIntegerTest extends TestCase
    {
        public static function isIntegerPositiveDataProvider(): array
        {
            return [
                ['1'],
                ['-2'],
                ['0']
            ];
        }

        #[DataProvider('isIntegerPositiveDataProvider')]
        public function testClassShouldValidateIsInteger(string $number): void
        {
            $result = (new IsInteger())->validate($number);
            $this->assertTrue($result);
        }

        public static function isIntegerNegativeDataProvider(): array
        {
            return [
                ['1.1'],
                ['-0.99'],
                ['abc'],
            ];
        }

        #[DataProvider('isIntegerNegativeDataProvider')]
        public function testClassShouldValidateIsNotInteger(string $number): void
        {
            $result = (new IsInteger())->validate($number);
            $this->assertFalse($result);
        }
    }
