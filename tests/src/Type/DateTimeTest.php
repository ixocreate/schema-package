<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeType as DBALDateTimeType;
use Exception;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\DateTimeElement;
use Ixocreate\Schema\Type\DateTimeType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Type\DateTimeType
 */
final class DateTimeTest extends TestCase
{
    public function testCreate()
    {
        $dateTimeType = new DateTimeType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));

        $newDateTimeType = $dateTimeType->create(1355314332);
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));

        $newDateTimeType = $dateTimeType->create(new DateTime('2012-12-12 12:12:12'));
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));

        $newDateTimeType = $dateTimeType->create([
            'date' => '2012-12-12 12:12:12.000000',
            'timezone_type' => 1,
            'timezone' => '+00:00',
        ]);
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));
    }

    public function testInvalidValue()
    {
        $this->expectException(Exception::class);
        $dateTimeType = new DateTimeType();
        $dateTimeType->create([]);
    }

    public function testToString()
    {
        $dateTimeType = new DateTimeType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');

        $this->assertSame((new DateTime('2012-12-12 12:12:12'))->format('c'), (string) $newDateTimeType);
    }

    public function testJsonserialize()
    {
        $dateTimeType = new DateTimeType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');

        $this->assertSame('"' . (new DateTime('2012-12-12 12:12:12'))->format('c') . '"', \json_encode($newDateTimeType));
    }

    public function testConvertToDatabaseValue()
    {
        $dateTimeType = new DateTimeType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertInstanceOf(DateTimeImmutable::class, $newDateTimeType->convertToDatabaseValue());
        $this->assertSame((new DateTime('2012-12-12 12:12:12'))->format('c'), $newDateTimeType->convertToDatabaseValue()->format('c'));
    }

    public function testValue()
    {
        $dateTimeType = new DateTimeType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertInstanceOf(DateTimeImmutable::class, $newDateTimeType->value());
        $this->assertSame((new DateTime('2012-12-12 12:12:12'))->format('c'), $newDateTimeType->value()->format('c'));
    }

    public function testSerialize()
    {
        $dateTimeType = new DateTimeType();

        $dateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $newDateTimeType = \unserialize(\serialize($dateTimeType));
        $this->assertInstanceOf(DateTimeType::class, $newDateTimeType);
        $this->assertSame((new DateTime('2012-12-12 12:12:12'))->format('c'), $newDateTimeType->convertToDatabaseValue()->format('c'));

    }

    public function testProvideElement()
    {
        $mock = $this->createMock(BuilderInterface::class);
        $mock->expects($this->any())
            ->method('get')
            ->with(DateTimeElement::class);

        $dateTimeType = new DateTimeType();
        $dateTimeType->provideElement($mock);

        $this->addToAssertionCount(1);
    }

    public function testServiceName()
    {
        $this->assertSame('datetime', DateTimeType::serviceName());
    }

    public function testBaseDatabaseType()
    {
        $this->assertSame(DBALDateTimeType::class, DateTimeType::baseDatabaseType());
    }
}
