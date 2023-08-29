<?php

namespace App\Domain\ValueObject;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class PrevInsuranceExpirationDate
{
    public const PREV_INSURANCE_EXPIRATION_DATE_ERROR_MESSAGES =
        'The expiration date of the insurance must not be less than the date of the driver license.';

    private DateTimeInterface $prevInsuranceExpirationDate;

    public function __construct(DateTimeInterface $prevInsuranceExpirationDate, DateTimeInterface $driveLicenceDate)
    {
        $this->validate($prevInsuranceExpirationDate, $driveLicenceDate);

        $this->prevInsuranceExpirationDate = $prevInsuranceExpirationDate;
    }

    public function getValue(): DateTimeInterface
    {
        return $this->prevInsuranceExpirationDate;
    }

    private function validate(DateTimeInterface $prevInsuranceExpirationDate, DateTimeInterface $driveLicenceDate): void
    {
        if ($prevInsuranceExpirationDate < $driveLicenceDate) {
            throw new BadRequestException(
                self::PREV_INSURANCE_EXPIRATION_DATE_ERROR_MESSAGES,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
