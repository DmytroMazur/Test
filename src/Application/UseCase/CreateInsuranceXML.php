<?php

namespace App\Application\UseCase;

use App\Application\Dto\InputParameterDTO;
use App\Domain\InsuranceInterface;
use App\Domain\Model\Insurance;
use App\Domain\ValueObject\DriverBirthdate;
use App\Domain\ValueObject\DriverChildren;
use App\Domain\ValueObject\DriverCivilStatus;
use App\Domain\ValueObject\DriverId;
use App\Domain\ValueObject\DriverLicenceDate;
use App\Domain\ValueObject\PrevInsuranceExists;
use App\Domain\ValueObject\PrevInsuranceExpirationDate;

class CreateInsuranceXML
{
    public function createXML(InputParameterDTO $inputParameterDTO, InsuranceInterface $insuranceInterface): string
    {
        $insurance = new Insurance(
            new DriverId($inputParameterDTO->getDriverId()),
            new DriverLicenceDate($inputParameterDTO->getDriverLicenceDate()),
            new DriverCivilStatus($inputParameterDTO->getDriverCivilStatus()),
            new DriverChildren($inputParameterDTO->getDriverChildren()),
            null !== $inputParameterDTO->getDriverBirthdate() ?
                new DriverBirthdate($inputParameterDTO->getDriverBirthdate()) : null,
            new PrevInsuranceExists($inputParameterDTO->getPrevInsuranceExists()),
            null !== $inputParameterDTO->getPrevInsuranceExpirationDate() ?
                new PrevInsuranceExpirationDate($inputParameterDTO->getPrevInsuranceExpirationDate(), $inputParameterDTO->getDriverLicenceDate()) : null
        );

        return $insuranceInterface->createXML($insurance);
    }
}
