<?php

namespace App\Application\UseCase;

use App\Application\Dto\InputParameterDTO;
use App\Domain\InsuranceInterface;
use App\Domain\Model\Insurance;
use App\Domain\ValueObject\DriverBirthDate;
use App\Domain\ValueObject\DriverChildren;
use App\Domain\ValueObject\DriverCivilStatus;
use App\Domain\ValueObject\DriverId;
use App\Domain\ValueObject\DriverLicenceDate;

class CreateInsuranceXML
{
    public function createXML(InputParameterDTO $inputParameterDTO, InsuranceInterface $insuranceInterface): string
    {
        $insurance = new Insurance(
            new DriverId($inputParameterDTO->getDriverId()),
            new DriverLicenceDate($inputParameterDTO->getDriverLicenceDate()),
            new DriverCivilStatus($inputParameterDTO->getDriverCivilStatus()),
            new DriverChildren($inputParameterDTO->getDriverChildren()),
            null !== $inputParameterDTO->getDriverBirthDate() ?
                new DriverBirthDate($inputParameterDTO->getDriverBirthDate()) : null
        );

        return $insuranceInterface->builtXml($insurance);
    }
}
