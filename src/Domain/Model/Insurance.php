<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\DriverBirthDate;
use App\Domain\ValueObject\DriverChildren;
use App\Domain\ValueObject\DriverCivilStatus;
use App\Domain\ValueObject\DriverId;
use App\Domain\ValueObject\DriverLicenceDate;

class Insurance
{
    public function __construct(
        private readonly DriverId $driverId,
        private readonly DriverLicenceDate $driverLicenceDate,
        private readonly DriverCivilStatus $driverCivilStatus,
        private readonly DriverChildren $driverChildren,
        private readonly ?DriverBirthDate $driverBirthDate
    ) {}

    public function getDriverId(): DriverId
    {
        return $this->driverId;
    }

    public function getDriverLicenceDate(): DriverLicenceDate
    {
        return $this->driverLicenceDate;
    }

    public function getDriverCivilStatus(): DriverCivilStatus
    {
        return $this->driverCivilStatus;
    }

    public function getDriverChildren(): DriverChildren
    {
        return $this->driverChildren;
    }

    public function getDriverBirthDate(): ?DriverBirthDate
    {
        return $this->driverBirthDate;
    }
}
