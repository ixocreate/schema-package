<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\ListElement;

interface ListElementInterface extends \JsonSerializable
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
