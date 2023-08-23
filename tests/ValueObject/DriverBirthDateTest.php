<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\DriverBirthDate;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverBirthDateTest extends TestCase
{
    /**
     * @dataProvider validDriverBirthDateProvider
     */
    public function testValidDriverBirthDate($validBirthDate): void
    {
        $driverBirthDate = new DriverBirthDate($validBirthDate);
        $this->assertSame($validBirthDate, $driverBirthDate->getDriverBirthDate());
    }

    /**
     * @dataProvider invalidDriverBirthDateProvider
     */
    public function testInvalidDriverBirthDateThrowsException($invalidBirthDate): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(DriverBirthDate::DRIVER_CIVIL_STATUS_ERROR_MESSAGES);

        new DriverBirthDate($invalidBirthDate);
    }

    public function validDriverBirthDateProvider(): array
    {
        return [
            [new DateTime('2000-01-01')],
            [new DateTime('1990-12-31')],
        ];
    }

    public function invalidDriverBirthDateProvider(): array
    {
        return [
            [new DateTime('tomorrow')],
            [new DateTime('-5 years')],
        ];
    }
}