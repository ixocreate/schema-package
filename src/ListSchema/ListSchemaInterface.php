<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\ListSchema;

use Ixocreate\Schema\ListElement\ListElementInterface;

interface ListSchemaInterface extends \JsonSerializable
{
    /**
     * @return ListElementInterface[]
     */
    public function elements(): array;

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param ListElementInterface $element
     * @return ListSchemaInterface
     */
    public function withAddedElement(ListElementInterface $element): ListSchemaInterface;

    /**
     * @return array
     */
    public function defaultSorting(): ?array;

    /**
     * @param string $defaultSorting
     * @param string $direction
     * @return ListSchemaInterface
     */
    public function withDefaultSorting(string $defaultSorting, string $direction): ListSchemaInterface;
}
