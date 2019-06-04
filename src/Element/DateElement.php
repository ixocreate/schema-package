<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\DateType;

final class DateElement extends AbstractSingleElement
{
    public function inputType(): string
    {
        return 'date';
    }

    public function type(): string
    {
        return DateType::class;
    }

    public static function serviceName(): string
    {
        return 'date';
    }
}
