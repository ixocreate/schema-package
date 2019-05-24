<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

interface DatabaseTypeInterface
{
    /**
     * @return mixed
     */
    public function convertToDatabaseValue();

    /**
     * @return string
     */
    public static function baseDatabaseType(): string;
}
