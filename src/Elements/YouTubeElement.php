<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\YouTubeType;

final class YouTubeElement extends AbstractSingleElement
{
    public function type(): string
    {
        return YouTubeType::class;
    }

    public function inputType(): string
    {
        return 'youtube';
    }

    public static function serviceName(): string
    {
        return 'youtube';
    }
}
