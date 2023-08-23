<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\DriverId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverIdTest extends TestCase
{
    /**
     * @dataProvider validDriverIdProvider
     */
    public function testValidDriverId(string $validDriverId): void
    {
        $driverId = new DriverId($validDriverId);
        $this->assertSame($validDriverId, $driverId->getDriverId());
    }

    /**
     * @dataProvider invalidDriverIdProvider
     */
    public function testInvalidDriverIdThrowsException(string $invalidDriverId): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(sprintf('%s %s', DriverId::DRIVER_ID_ERROR_MESSAGES, $invalidDriverId));

        new DriverId($invalidDriverId);
    }

    private function validDriverIdProvider(): array
    {
        return [
            ['X12345678Y'],
            ['Y98765432X'],
            ['Z55555555A'],
        ];
    }

    private function invalidDriverIdProvider(): array
    {
        return [
            ['ABC12345D'],
            ['1234567891234A'],
            ['X9876Y'],
        ];
    }
}
