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
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Media\Type\AudioType;

final class AudioElement extends AbstractSingleElement
{
    public function type(): string
    {
        return AudioType::class;
    }

    public function inputType(): string
    {
        return 'audio';
    }

    public static function serviceName(): string
    {
        return 'audio';
    }
}