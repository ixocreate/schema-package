<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Assert\Assertion;
use Doctrine\DBAL\Types\GuidType;
use Ramsey\Uuid\UuidInterface;

final class UuidType extends AbstractType implements DatabaseTypeInterface
{
    /**
     * @param $value
     * @throws \Assert\AssertionFailedException
     * @return string
     */
    protected function transform($value)
    {
        if ($value instanceof UuidInterface) {
            return (string)$value;
        }

        Assertion::uuid($value);

        return $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function convertToDatabaseValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return GuidType::class;
    }

    public static function serviceName(): string
    {
        return 'uuid';
    }
}
