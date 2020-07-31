<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Doctrine\DBAL\Types\StringType;

final class VimeoType extends AbstractType implements DatabaseTypeInterface
{
    /**
     * @param $value
     * @return string
     */
    protected function transform($value)
    {
        return $value;
    }

    /**
     * @return string
     */
    public function convertToDatabaseValue()
    {
        return (string)$this;
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return StringType::class;
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'vimeo';
    }
}
