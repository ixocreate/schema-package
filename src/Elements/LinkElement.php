<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Type\Entity\LinkType;

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
