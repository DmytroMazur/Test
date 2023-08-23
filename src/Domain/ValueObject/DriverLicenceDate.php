<?php

namespace App\Domain\ValueObject;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverLicenceDate
{
    public const DRIVER_LICENCE_DATE_ERROR_MESSAGES = 'Invalid driver licence date';

    private DateTimeInterface $driverLicenceDate;

    public function __construct(DateTimeInterface $driverLicenceDate)
    {
        $this->validate($driverLicenceDate);

        $this->driverLicenceDate = $driverLicenceDate;
    }

    public function getDriverLicenceDate(): DateTimeInterface
    {
        return $this->driverLicenceDate;
    }

    /**
     * @throws BadRequestException when driver licence date > current date
     */
    private function validate(DateTimeInterface $driverLicenceDate): void
    {
        if ($driverLicenceDate->format('Y-m-d') > date('Y-m-d')) {
            throw new BadRequestException(self::DRIVER_LICENCE_DATE_ERROR_MESSAGES);
        }
    }
}
