<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\YouTubeType;

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
