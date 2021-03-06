<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\ListSchema;

use Ixocreate\Schema\ListElement\ListElementInterface;

final class ListSchema implements ListSchemaInterface
{
    /**
     * @var ListElementInterface[]
     */
    private $elements = [];

    /**
     * @var null|array
     */
    private $defaultSorting = null;

    /**
     * @return ListElementInterface[]
     */
    public function elements(): array
    {
        return $this->elements;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return \array_key_exists($name, $this->elements());
    }

    /**
     * @param ListElementInterface $element
     * @return ListSchemaInterface
     */
    public function withAddedElement(ListElementInterface $element): ListSchemaInterface
    {
        $schema = clone $this;
        $schema->elements[$element->name()] = $element;

        return $schema;
    }

    /**
     * @return array
     */
    public function defaultSorting(): ?array
    {
        return $this->defaultSorting;
    }

    /**
     * @param string $defaultSorting
     * @param string $direction
     * @return ListSchemaInterface
     */
    public function withDefaultSorting(string $defaultSorting, string $direction): ListSchemaInterface
    {
        $schema = clone $this;
        $schema->defaultSorting = [
            'sorting' => $defaultSorting,
            'direction' => $direction,
        ];

        return $schema;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'elements' => \array_values($this->elements),
            'defaultSorting' => $this->defaultSorting,
        ];
    }
}
