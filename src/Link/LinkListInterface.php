<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Link;

interface LinkListInterface
{
    /**
     * The url that admin frontend will use to pull the options list from
     *
     * @return string
     */
    public function listUrl(): string;

    /**
     * Whether or not this link type should make a distinction between locales
     * Used in admin frontend to add the selected locale as url parameter
     *
     * @return bool
     */
    public function hasLocales(): bool;
}
