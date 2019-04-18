<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Media\Package\Type\VideoType;

final class VideoElement extends AbstractSingleElement
{
    public function type(): string
    {
        return VideoType::class;
    }

    public function inputType(): string
    {
        return 'video';
    }

    public static function serviceName(): string
    {
        return 'video';
    }
}
