<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Doctrine\DBAL\Types\DateType as DBALDateType;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\DateElement;
use Ixocreate\Schema\Element\ElementInterface;
use Ixocreate\Schema\Element\ElementProviderInterface;

final class DateType extends AbstractType implements DatabaseTypeInterface, ElementProviderInterface
{
    /**
     * @param $value
     * @throws \Exception
     * @return \DateTimeImmutable
     */
    protected function transform($value)
    {
        if ($value instanceof \DateTime) {
            return \DateTimeImmutable::createFromMutable($value);
        }

        if ($value instanceof \DateTimeImmutable) {
            return $value;
        }

        if (\is_string($value)) {
            $value = \strtotime($value);
        }

        if (\is_int($value)) {
            return new \DateTimeImmutable('@' . $value);
        }

        if (\is_array($value) && \array_key_exists('date', $value) && \array_key_exists('timezone', $value)) {
            return new \DateTimeImmutable($value['date'], new \DateTimeZone($value['timezone']));
        }

        throw new \Exception('invalid date format');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->value() === null) ? null : $this->value()->format('Y-m-d');
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
        return DBALDateType::class;
    }

    public static function serviceName(): string
    {
        return 'date';
    }

    public function provideElement(BuilderInterface $builder): ElementInterface
    {
        return $builder->get(DateElement::class);
    }
}
