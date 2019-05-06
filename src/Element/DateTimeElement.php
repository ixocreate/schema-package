<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\DateTimeType;

final class DateTimeElement extends AbstractSingleElement
{
    public function inputType(): string
    {
        return 'datetime';
    }

    public function type(): string
    {
        return DateTimeType::class;
    }

    public static function serviceName(): string
    {
        return 'datetime';
    }
}
