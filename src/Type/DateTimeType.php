<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeType as DBALDateTimeType;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\DateTimeElement;
use Ixocreate\Schema\Element\ElementInterface;
use Ixocreate\Schema\Element\ElementProviderInterface;

final class DateTimeType extends AbstractType implements DatabaseTypeInterface, ElementProviderInterface
{
    private $dateTime = null;

    private $initialized = false;

    /**
     * @param $value
     * @throws \Exception
     * @return \DateTimeImmutable
     */
    protected function transform($value)
    {
        if ($value instanceof \DateTimeInterface) {
            return $value;
        }

        if (\is_string($value)) {
            $value = \strtotime($value);
        }

        if (\is_int($value)) {
            return $value;
        }

        if (\is_array($value) && \array_key_exists('date', $value) && \array_key_exists('timezone', $value)) {
            return $value;
        }

        throw new \Exception("invalid date format");
    }

    private function generateDateTime($value): DateTimeImmutable
    {
        if ($value instanceof \DateTimeInterface) {
            return DateTimeImmutable::createFromMutable($value);
        }

        if (\is_int($value)) {
            return new \DateTimeImmutable('@' . $value);
        }

        if (\is_array($value) && \array_key_exists('date', $value) && \array_key_exists('timezone', $value)) {
            return new \DateTimeImmutable($value['date'], new \DateTimeZone($value['timezone']));
        }
    }

    public function value()
    {
        if ($this->initialized === false) {
            $this->initialized = true;
            $this->dateTime = $this->generateDateTime(parent::value());
        }
        return $this->dateTime;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->value() === null) ? null : $this->value()->format('c');
    }

    public function format($format): string
    {
        if ($this->value() === null) {
            return "";
        }
        return $this->value()->format($format);
    }

    /**
     * @return string
     */
    public function convertToDatabaseValue()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return DBALDateTimeType::class;
    }

    public static function serviceName(): string
    {
        return 'datetime';
    }

    public function provideElement(BuilderInterface $builder): ElementInterface
    {
        return $builder->get(DateTimeElement::class);
    }
}
