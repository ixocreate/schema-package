<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Type\TypeInterface;

final class TextareaElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'textarea';
    }

    public static function serviceName(): string
    {
        return 'textarea';
    }
}
