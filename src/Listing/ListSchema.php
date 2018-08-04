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
namespace KiwiSuite\Schema\Listing;

use KiwiSuite\Contract\Schema\Listing\ElementInterface;
use KiwiSuite\Contract\Schema\Listing\ListSchemaInterface;

final class ListSchema implements ListSchemaInterface
{
    /**
     * @var ElementInterface[]
     */
    private $elements = [];

    /**
     * @var null|array
     */
    private $defaultSorting = null;

    /**
     * @return ElementInterface[]
     */
    public function elements(): array
    {
        return $this->elements;
    }

    /**
     * @param ElementInterface $element
     * @return ListSchemaInterface
     */
    public function withAddedElement(ElementInterface $element): ListSchemaInterface
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
