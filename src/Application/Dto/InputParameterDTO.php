<?php

namespace App\Application\Dto;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class InputParameterDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('DateTimeInterface')]
    private ?DateTimeInterface $driverLicenceDate;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $driverId;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $driverCivilStatus;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $driverChildren;

    #[Assert\Type('DateTimeInterface')]
    private ?DateTimeInterface $driverBirthdate;

    #[Assert\NotBlank]
    private ?string $prevInsuranceExists;

    #[Assert\Type('DateTimeInterface')]
    private ?DateTimeInterface $prevInsuranceExpirationDate;

    public function __construct(
        ?string $driverLicenceDate,
        ?string $driverId,
        ?string $driverCivilStatus,
        ?string $driverChildren,
        ?string $driverBirthdate,
        ?string $prevInsuranceExists,
        ?string $prevInsuranceExpirationDate
    ) {
        $this->driverLicenceDate = !empty($driverLicenceDate) ? DateTime::createFromFormat('Y-m-d', $driverLicenceDate) : null;
        $this->driverId = $driverId;
        $this->driverCivilStatus = $driverCivilStatus;
        $this->driverChildren = $driverChildren;
        $this->driverBirthdate = !empty($driverBirthdate) ? DateTime::createFromFormat('Y-m-d', $driverBirthdate) : null;
        $this->prevInsuranceExists = $prevInsuranceExists;
        $this->prevInsuranceExpirationDate = !empty($prevInsuranceExpirationDate) ?
            DateTime::createFromFormat('Y-m-d', $prevInsuranceExpirationDate) : null;
    }

    public function getDriverLicenceDate(): DateTimeInterface
    {
        return $this->driverLicenceDate;
    }

    public function getDriverId(): string
    {
        return $this->driverId;
    }

    public function getDriverCivilStatus(): string
    {
        return $this->driverCivilStatus;
    }

    public function getDriverChildren(): string
    {
        return $this->driverChildren;
    }

    public function getDriverBirthdate(): ?DateTimeInterface
    {
        return $this->driverBirthdate;
    }

    public function getPrevInsuranceExists(): string
    {
        return $this->prevInsuranceExists;
    }

    public function getPrevInsuranceExpirationDate(): ?DateTimeInterface
    {
        return $this->prevInsuranceExpirationDate;
    }
}
