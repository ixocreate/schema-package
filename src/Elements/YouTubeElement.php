<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Elements;

use Ixocreate\Package\Type\Entity\YouTubeType;

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
