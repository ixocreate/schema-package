<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Media\Type\ImageType;

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
