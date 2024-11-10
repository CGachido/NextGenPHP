<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator as InterfacesValidator;

class Validator
{
    protected $validations = [];
    public function addValidation(InterfacesValidator $validator): self
    {
        $this->validations[] = $validator;
        return $this;
    }

    public function validate(string $number)
    {
        foreach ($this->validations as $validator) {
            $valid = $validator->validate($number);
            if (!$valid) {
                return false;
            }
        }
        return true;
    }
}
