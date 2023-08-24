<?php

namespace App\Tests\ValueObject;

use App\Domain\Enum\CivilStatus;
use App\Domain\ValueObject\DriverCivilStatus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverCivilStatusTest extends TestCase
{
    /**
     * @dataProvider validCivilStatusProvider
     */
    public function testValidCivilStatus(CivilStatus $civilStatus): void
    {
        $driverCivilStatus = new DriverCivilStatus($civilStatus->name);
        $this->assertSame($civilStatus->name, $driverCivilStatus->getValue());
    }

    /**
     * @dataProvider invalidCivilStatusProvider
     */
    public function testInvalidCivilStatusThrowsException($invalidCivilStatus): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(sprintf('%s %s',DriverCivilStatus::DRIVER_CIVIL_STATUS_ERROR_MESSAGES, $invalidCivilStatus));

        new DriverCivilStatus($invalidCivilStatus);
    }

    public function validCivilStatusProvider(): array
    {
        return [
            [CivilStatus::Soltero],
            [CivilStatus::Casado],
        ];
    }

    public function invalidCivilStatusProvider(): array
    {
        return [
            ['Complicado'],
            ['Sin estado'],
        ];
    }
}
