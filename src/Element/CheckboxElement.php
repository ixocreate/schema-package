<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\TypeInterface;

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
