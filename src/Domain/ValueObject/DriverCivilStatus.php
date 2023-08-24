<?php

namespace App\Domain\ValueObject;

use App\Domain\Enum\CivilStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverCivilStatus
{
    public const DRIVER_CIVIL_STATUS_ERROR_MESSAGES = 'Invalid civil status:';

    private CivilStatus $civilStatus;

    public function __construct(string $civilStatus)
    {
        $this->validate($civilStatus);

        $this->civilStatus = 'Soltero'=== $civilStatus ? CivilStatus::Soltero : CivilStatus::Casado;
    }

    public function getValue(): string
    {
        return $this->civilStatus->name;
    }

    /**
     * @throws BadRequestException when invalid civil status
     */
    private function validate(string $civilStatus): void
    {
        if (!in_array($civilStatus, [CivilStatus::Soltero->name, CivilStatus::Casado->name])) {
            throw new BadRequestException(sprintf('%s %s',
                self::DRIVER_CIVIL_STATUS_ERROR_MESSAGES,
                $civilStatus
            ));
        }
    }
}