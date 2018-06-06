<?php
namespace KiwiSuite\Schema;

interface ElementInterface extends \JsonSerializable
{
    public function type(): string;

    public function name(): string;

    public function label(): string;

    public function metadata(): array;

    public function withName(string $name): ElementInterface;

    public function withLabel(string $label): ElementInterface;

    public function withMetadata(array $metadata): ElementInterface;

    public function withAddedMetadata(string $key, $value): ElementInterface;
}
