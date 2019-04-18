<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Type\Package\TypeInterface;

final class NumberElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_INT;
    }

    public function inputType(): string
    {
        return 'number';
    }

    public static function serviceName(): string
    {
        return 'number';
    }
}
