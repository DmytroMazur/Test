<?php

namespace App\Domain\ValueObject;

use DateTime;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class DriverBirthdate
{
    private const MIN_AGE = 18;
    public const DRIVER_BIRTHDATE_ERROR_MESSAGES = 'Driver must be at least 18 years old';

    private DateTimeInterface $driverBirthdate;

    public function __construct(DateTimeInterface $driverBirthdate)
    {
        $this->validate($driverBirthdate);

        $this->driverBirthdate = $driverBirthdate;
    }

    public function getValue(): ?DateTimeInterface
    {
        return $this->driverBirthdate;
    }

    private function validate(DateTimeInterface $driverBirthdate)
    {
        $currentDate = new DateTime();
        $diff = $currentDate->diff($driverBirthdate);

        if ($diff->y < self::MIN_AGE) {
            throw new BadRequestException(self::DRIVER_BIRTHDATE_ERROR_MESSAGES, Response::HTTP_BAD_REQUEST);
        }
    }
}
