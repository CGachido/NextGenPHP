I<?php

    use DifferDev\IsBoolean;
    use PHPUnit\Framework\Attributes\CoversClass;
    use PHPUnit\Framework\Attributes\DataProvider;
    use PHPUnit\Framework\TestCase;

    #[CoversClass(IsBoolean::class)]
    final class IsBooleanTest extends TestCase
    {
        public static function isBooleanPositiveDataProvider(): array
        {
            return [
                ['0'],
                ['1'],
                [true],
                [false],
                [TRUE],
                [FALSE],
            ];
        }

        #[DataProvider('isBooleanPositiveDataProvider')]
        public function testClassShouldValidateIsBoolean(string|bool $number): void
        {
            $result = (new IsBoolean())->validate($number);
            $this->assertTrue($result);
        }

        public static function isBooleanNegativeDataProvider(): array
        {
            return [
                ['1.1'],
                ['-0.99'],
                ['abc'],
                ['-1'],
                ['-0'],
            ];
        }

        #[DataProvider('isBooleanNegativeDataProvider')]
        public function testClassShouldNotValidateIsNotBoolean(string|bool $number): void
        {
            $result = (new IsBoolean())->validate($number);
            $this->assertFalse($result);
        }
    }
