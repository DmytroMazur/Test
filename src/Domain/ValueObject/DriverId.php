<?php

namespace App\Domain\ValueObject;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverId
{
    private const DRIVER_ID_PATTERN = '/^[XYZ\d]\d{7,8}[A-HJ-NP-TV-Z]$/';
    public const DRIVER_ID_ERROR_MESSAGES = 'Invalid driver id';

    private string $driverId;
    public function __construct(string $driverId)
    {
        $this->validate($driverId);

        $this->driverId = $driverId;
    }

    /**
     * @throws BadRequestException when driver id is invalid
     */
    private function validate(string $driverId): void
    {
        if (1 !== preg_match(self::DRIVER_ID_PATTERN, $driverId)) {
            throw new BadRequestException(sprintf('%s %s', self::DRIVER_ID_ERROR_MESSAGES, $driverId));
        }
    }

    public function getDriverId(): string
    {
        return $this->driverId;
    }
}