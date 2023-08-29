<?php

namespace App\Domain\ValueObject;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PrevInsuranceExists
{
    public const PREV_INSURANCE_ERROR_MESSAGES = 'Invalid prev insurance:';
    private string $prevInsuranceExists;

    public function __construct(string $prevInsuranceExists)
    {
        $this->validate($prevInsuranceExists);

        $this->prevInsuranceExists = ('SI' === $prevInsuranceExists);
    }

    public function getValue(): bool
    {
        return $this->prevInsuranceExists;
    }

    private function validate(string $prevInsuranceExists): void
    {
        if (!in_array(trim($prevInsuranceExists), ['SI', 'NO'])) {
            throw new BadRequestException(sprintf('%s %s',
                self::PREV_INSURANCE_ERROR_MESSAGES,
                $prevInsuranceExists
            ));
        }
    }
}
