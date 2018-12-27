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

use Ixocreate\CommonTypes\Entity\LinkType;

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
