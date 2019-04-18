<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package;

use Ixocreate\ServiceManager\NamedServiceInterface;

interface ElementInterface extends \JsonSerializable, NamedServiceInterface
{
    /**
     * @return string
     */
    public function inputType(): string;

    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return string|null
     */
    public function label(): ?string;

    /**
     * @return string|null
     */
    public function description(): ?string;

    /**
     * @return array
     */
    public function metadata(): array;

    /**
     * @param string $name
     * @return ElementInterface
     */
    public function withName(string $name): ElementInterface;

    /**
     * @param string $label
     * @return ElementInterface
     */
    public function withLabel(string $label): ElementInterface;

    /**
     * @param string $description
     * @return ElementInterface
     */
    public function withDescription(string $description): ElementInterface;

    /**
     * @param array $metadata
     * @return ElementInterface
     */
    public function withMetadata(array $metadata): ElementInterface;

    /**
     * @param string $key
     * @param $value
     * @return ElementInterface
     */
    public function withAddedMetadata(string $key, $value): ElementInterface;
}
