<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\PrevInsuranceExpirationDate;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PrevInsuranceExpirationDateTest extends TestCase
{
    /**
     * @dataProvider validDatesProvider
     */
    public function testValidPrevInsuranceExpirationDate(DateTime $prevInsuranceExpirationDate, DateTime $driveLicenceDate): void
    {
        $valueObject = new PrevInsuranceExpirationDate($prevInsuranceExpirationDate, $driveLicenceDate);

        $this->assertSame($prevInsuranceExpirationDate, $valueObject->getValue());
    }

    /**
     * @dataProvider invalidDatesProvider
     */
    public function testInvalidPrevInsuranceExpirationDate(DateTime $prevInsuranceExpirationDate, DateTime $driveLicenceDate): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(PrevInsuranceExpirationDate::PREV_INSURANCE_EXPIRATION_DATE_ERROR_MESSAGES);

        new PrevInsuranceExpirationDate($prevInsuranceExpirationDate, $driveLicenceDate);
    }

    public function validDatesProvider(): array
    {
        return [
            [new DateTime('2022-12-31'), new DateTime('2022-01-01')],
            [new DateTime('2021-01-01'), new DateTime('2020-01-01')],
        ];
    }

    public function invalidDatesProvider(): array
    {
        return [
            [new DateTime('2020-01-01'), new DateTime('2023-01-01')],
        ];
    }
}

