<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\CommonTypes\Entity\YouTubeType;

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
