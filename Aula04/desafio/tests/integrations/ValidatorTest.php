<?php

use DifferDev\IsEven;
use DifferDev\IsGreaterThan;
use DifferDev\IsInteger;
use DifferDev\Validator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Validator::class)]
#[CoversClass(IsEven::class)]
#[CoversClass(IsGreaterThan::class)]
#[CoversClass(IsInteger::class)]
final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testClassValidatorShouldAggregateMultipleValidations(): void
    {
        $validator = new Validator();
        $validationGroup = $validator->addValidation(new IsInteger())
            ->addValidation(new IsGreaterThan(200))
            ->addValidation(new IsEven());
        $result = $validationGroup->validate(302);
        $this->assertTrue($result);
    }

    public function testClassValidatorShouldNotIsValidWithInvalidValidationAggregated(): void
    {
        $validator = new Validator();
        $validationGroup = $validator->addValidation(new IsInteger())
            ->addValidation(new IsGreaterThan(200))
            ->addValidation(new IsEven());
        $result = $validationGroup->validate(301);
        $this->assertFalse($result);
    }
}
