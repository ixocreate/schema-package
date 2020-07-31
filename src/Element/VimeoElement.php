<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\VimeoType;

final class VimeoElement extends AbstractSingleElement
{
    /**
     * @return string
     */
    public function type(): string
    {
        return VimeoType::class;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'vimeo';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'vimeo';
    }
}
