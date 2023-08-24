<?php

namespace App\Domain\ValueObject;

use DateTime;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class DriverBirthDate
{
    private const MIN_AGE = 18;
    public const DRIVER_CIVIL_STATUS_ERROR_MESSAGES = 'Driver must be at least 18 years old';

    private DateTimeInterface $driverBirthDate;

    public function __construct(DateTimeInterface $driverBirthDate)
    {
        $this->validate($driverBirthDate);

        $this->driverBirthDate = $driverBirthDate;
    }

    public function getValue(): ?DateTimeInterface
    {
        return $this->driverBirthDate;
    }

    private function validate(DateTimeInterface $driverBirthDate)
    {
        $currentDate = new DateTime();

        $diff = $currentDate->diff($driverBirthDate);
        if ($diff->y < self::MIN_AGE) {
            throw new BadRequestException(self::DRIVER_CIVIL_STATUS_ERROR_MESSAGES, Response::HTTP_BAD_REQUEST);
        }
    }
}