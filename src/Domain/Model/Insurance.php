<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\DriverBirthdate;
use App\Domain\ValueObject\DriverChildren;
use App\Domain\ValueObject\DriverCivilStatus;
use App\Domain\ValueObject\DriverId;
use App\Domain\ValueObject\DriverLicenceDate;
use App\Domain\ValueObject\PrevInsuranceExists;
use App\Domain\ValueObject\PrevInsuranceExpirationDate;

class Insurance
{
    public function __construct(
        private readonly DriverId                     $driverId,
        private readonly DriverLicenceDate            $driverLicenceDate,
        private readonly DriverCivilStatus            $driverCivilStatus,
        private readonly DriverChildren               $driverChildren,
        private readonly ?DriverBirthdate             $driverBirthdate,
        private readonly PrevInsuranceExists          $prevInsuranceExists,
        private readonly ?PrevInsuranceExpirationDate $prevInsuranceExpirationDate
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

    public function getDriverBirthdate(): ?DriverBirthdate
    {
        return $this->driverBirthdate;
    }

    public function IsPrevInsuranceExist(): PrevInsuranceExists
    {
        return $this->prevInsuranceExists;
    }

    public function getPrevInsuranceExpirationDate(): ?PrevInsuranceExpirationDate
    {
        return $this->prevInsuranceExpirationDate;
    }
}
