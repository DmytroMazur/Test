<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\DriverLicenceDate;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverLicenceDateTest extends TestCase
{
    /**
     * @dataProvider validDriverLicenceDateProvider
     */
    public function testValidDriverLicenceDate($validDate): void
    {
        $driverLicenceDate = new DriverLicenceDate($validDate);
        $this->assertSame($validDate, $driverLicenceDate->getValue());
    }

    /**
     * @dataProvider invalidDriverLicenceDateProvider
     */
    public function testFutureDriverLicenceDateThrowsException($futureDate): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(DriverLicenceDate::DRIVER_LICENCE_DATE_ERROR_MESSAGES);

        new DriverLicenceDate($futureDate);
    }

    public function validDriverLicenceDateProvider(): array
    {
        return [
            [new DateTime('2020-01-01')],
            [new DateTime('2005-12-31')],
        ];
    }

    public function invalidDriverLicenceDateProvider(): array
    {
        return [
            [new DateTime('tomorrow')],
            [new DateTime('+1 week')],
        ];
    }
}
