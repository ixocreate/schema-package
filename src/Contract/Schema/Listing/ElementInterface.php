<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Listing;

interface ElementInterface extends \JsonSerializable
{
    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return string
     */
    public function label(): string;

    /**
     * @return bool
     */
    public function sortable(): bool;

    /**
     * @return bool
     */
    public function searchable(): bool;

    /**
     * @return string
     */
    public function type(): string;
}
