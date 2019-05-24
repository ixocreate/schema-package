<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\LinkType;

final class LinkElement extends AbstractSingleElement
{
    public function type(): string
    {
        return LinkType::class;
    }

    public function inputType(): string
    {
        return 'link';
    }

    public static function serviceName(): string
    {
        return 'link';
    }
}
