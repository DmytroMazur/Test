<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\DriverBirthdate;
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
        $driverBirthDate = new DriverBirthdate($validBirthDate);
        $this->assertSame($validBirthDate, $driverBirthDate->getValue());
    }

    /**
     * @dataProvider invalidDriverBirthDateProvider
     */
    public function testInvalidDriverBirthDateThrowsException($invalidBirthDate): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(DriverBirthdate::DRIVER_BIRTHDATE_ERROR_MESSAGES);

        new DriverBirthdate($invalidBirthDate);
    }

    private function validDriverBirthDateProvider(): array
    {
        return [
            [new DateTime('2000-01-01')],
            [new DateTime('1990-12-31')],
        ];
    }

    private function invalidDriverBirthDateProvider(): array
    {
        return [
            [new DateTime('tomorrow')],
            [new DateTime('-5 years')],
        ];
    }
}
