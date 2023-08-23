<?php

namespace App\Tests\ValueObject;

use App\Domain\ValueObject\DriverChildren;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DriverChildrenTest extends TestCase
{
    /**
     * @dataProvider validDriverChildrenProvider
     */
    public function testValidDriverChildren($input, $expectedResult): void
    {
        $driverChildren = new DriverChildren($input);
        $this->assertSame($expectedResult, $driverChildren->isDriverChildren());
    }

    /**
     * @dataProvider invalidDriverChildrenProvider
     */
    public function testInvalidDriverChildrenThrowsException($invalidInput): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(sprintf('%s %s', DriverChildren::DRIVER_CHILDREN_ERROR_MESSAGES, $invalidInput));

        new DriverChildren($invalidInput);
    }

    public function validDriverChildrenProvider(): array
    {
        return [
            ['SI', true],
            ['NO', false],
        ];
    }

    public function invalidDriverChildrenProvider(): array
    {
        return [
            ['Yes'],
            ['Nope'],
            ['Maybe'],
        ];
    }
}
