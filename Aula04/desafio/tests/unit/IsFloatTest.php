I<?php

    use DifferDev\IsFloat;
    use PHPUnit\Framework\Attributes\CoversClass;
    use PHPUnit\Framework\Attributes\DataProvider;
    use PHPUnit\Framework\TestCase;

    #[CoversClass(IsFloat::class)]
    final class IsFloatTest extends TestCase
    {
        public static function isFloatPositiveDataProvider(): array
        {
            return [
                ['1.1'],
                ['-1.1'],
                ['0.00'],
                ['1.23e-4'],
            ];
        }

        #[DataProvider('isFloatPositiveDataProvider')]
        public function testClassShouldValidateIsFloat(string $number): void
        {
            $result = (new IsFloat())->validate($number);
            $this->assertTrue($result);
        }

        public static function isFloatNegativeDataProvider(): array
        {
            return [
                ['1'],
                ['0'],
                ['-1'],
                ['abc']
            ];
        }

        #[DataProvider('isFloatNegativeDataProvider')]
        public function testClassShouldValidateIsNotFloat(string $number): void
        {
            $result = (new IsFloat())->validate($number);
            $this->assertFalse($result);
        }
    }
