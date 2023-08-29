<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\PrevInsuranceExists;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PrevInsuranceExistsTest extends TestCase
{
    /**
     * @dataProvider validPrevInsuranceProvider
     */
    public function testValidPrevInsuranceExists(string $value, bool $expectedValue): void
    {
        $valueObject = new PrevInsuranceExists($value);

        $this->assertSame($expectedValue, $valueObject->getValue());
    }

    /**
     * @dataProvider invalidPrevInsuranceProvider
     */
    public function testInvalidPrevInsuranceExists(string $value): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(PrevInsuranceExists::PREV_INSURANCE_ERROR_MESSAGES);

        new PrevInsuranceExists($value);
    }

    public function validPrevInsuranceProvider(): array
    {
        return [
            ['SI', true],
            ['NO', false],
        ];
    }

    public function invalidPrevInsuranceProvider(): array
    {
        return [
            ['NO2'],
            ['SI1'],
        ];
    }
}
