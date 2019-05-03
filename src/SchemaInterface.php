<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Element\ElementInterface;

interface SchemaInterface extends \JsonSerializable
{
    /**
     * @param SchemaReceiverInterface $schemaReceiver
     * @return SchemaInterface
     * @deprecated
     */
    public function withSchemaReceiver(SchemaReceiverInterface $schemaReceiver): SchemaInterface;

    /**
     * @param ElementInterface ...$elements
     * @return SchemaInterface
     */
    public function withElements(ElementInterface ...$elements): SchemaInterface;

    /**
     * @return ElementInterface[]
     */
    public function elements(): array;

    /**
     * @return ElementInterface[]
     */
    public function all(): array;

    /**
     * @param string $name
     * @return SchemaInterface
     */
    public function remove(string $name): SchemaInterface;

    /**
     * @param string $name
     * @return ElementInterface
     */
    public function get(string $name): ElementInterface;

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @return SchemaReceiverInterface|null
     * @deprecated
     */
    public function schemaReceiver(): ?SchemaReceiverInterface;
}
