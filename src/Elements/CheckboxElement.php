<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Elements;

use Ixocreate\Package\Type\TypeInterface;

final class CheckboxElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_BOOL;
    }

    public function inputType(): string
    {
        return 'checkbox';
    }

    public static function serviceName(): string
    {
        return 'checkbox';
    }
}
