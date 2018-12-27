<?php
/**
 * kiwi-suite/schema (https://github.com/kiwi-suite/schema)
 *
 * @package kiwi-suite/schema
 * @link https://github.com/kiwi-suite/schema
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace Ixocreate\Schema\Elements;

use Ixocreate\Media\Type\ImageType;

final class ImageElement extends AbstractSingleElement
{
    public function type(): string
    {
        return ImageType::class;
    }

    public function inputType(): string
    {
        return 'image';
    }

    public static function serviceName(): string
    {
        return 'image';
    }
}
