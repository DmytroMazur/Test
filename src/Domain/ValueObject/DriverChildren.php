<?php

namespace App\Domain\ValueObject;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverChildren
{
    public const DRIVER_CHILDREN_ERROR_MESSAGES = 'Invalid driver children:';

    private bool $isDriverChildren;

    public function __construct(string $driverChildren)
    {
        $this->validate($driverChildren);

        $this->isDriverChildren = ('SI' === $driverChildren);
    }

    /**
     * @throws BadRequestException when invalid driver children
     */
    private function validate(string $driverChildren)
    {
        if (!in_array(trim($driverChildren), ['SI', 'NO'])) {
            throw new BadRequestException(sprintf('%s %s',
                self::DRIVER_CHILDREN_ERROR_MESSAGES,
                $driverChildren
            ));
        }
    }

    public function isDriverChildren(): bool
    {
        return $this->isDriverChildren;
    }
}
