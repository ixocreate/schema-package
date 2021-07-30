<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use Doctrine\DBAL\Types\DateType as DBALDateType;
use Exception;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\DateElement;
use Ixocreate\Schema\Type\DateType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Type\DateType
 */
final class DateTest extends TestCase
{
    public function testCreate()
    {
        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));

        $newDateTimeType = $dateTimeType->create(1355314332);
        $this->assertNotSame($dateTimeType, $newDateTimeType);
        $this->assertSame('2012-12-12 12:12:12', $newDateTimeType->value()->format('Y-m-d H:i:s'));

        $newDateTimeType = $dateTimeType->create(new \DateTime('2012-12-12 12:12:12'));
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
        $dateTimeType = new DateType();
        $dateTimeType->create([]);
    }

    public function testToString()
    {
        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');

        $this->assertSame((new \DateTime('2012-12-12 12:12:12'))->format('Y-m-d'), (string)$newDateTimeType);
    }

    /** @runInSeparateProcess  */
    public function testTimezone()
    {
        \date_default_timezone_set('UTC');

        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create(new \DateTime('2012-12-12 00:12:12', new \DateTimeZone('Europe/Vienna')));

        $this->assertSame('"' . (new \DateTime('2012-12-12 12:12:12'))->format('Y-m-d') . '"', \json_encode($newDateTimeType));
    }

    public function testJsonserialize()
    {
        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');

        $this->assertSame('"' . (new \DateTime('2012-12-12 12:12:12'))->format('Y-m-d') . '"', \json_encode($newDateTimeType));
    }

    public function testConvertToDatabaseValue()
    {
        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertInstanceOf(\DateTimeImmutable::class, $newDateTimeType->convertToDatabaseValue());
        $this->assertSame((new \DateTime('2012-12-12 12:12:12'))->format('c'), $newDateTimeType->convertToDatabaseValue()->format('c'));
    }

    public function testValue()
    {
        $dateTimeType = new DateType();

        $newDateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $this->assertInstanceOf(\DateTimeImmutable::class, $newDateTimeType->value());
        $this->assertSame((new \DateTime('2012-12-12 12:12:12'))->format('c'), $newDateTimeType->value()->format('c'));
    }

    public function testSerialize()
    {
        $dateTimeType = new DateType();

        $dateTimeType = $dateTimeType->create('2012-12-12 12:12:12');
        $newDateTimeType = \unserialize(\serialize($dateTimeType));
        $this->assertInstanceOf(DateType::class, $newDateTimeType);
        $this->assertSame((new \DateTime('2012-12-12 12:12:12'))->format('Y-m-d'), $newDateTimeType->__toString());
    }

    public function testProvideElement()
    {
        $mock = $this->createMock(BuilderInterface::class);
        $mock->expects($this->any())
            ->method('get')
            ->with(DateElement::class);

        $dateTimeType = new DateType();
        $dateTimeType->provideElement($mock);

        $this->addToAssertionCount(1);
    }

    public function testServiceName()
    {
        $this->assertSame('date', DateType::serviceName());
    }

    public function testBaseDatabaseType()
    {
        $this->assertSame(DBALDateType::class, DateType::baseDatabaseType());
    }
}
