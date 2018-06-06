<?php
namespace KiwiSuite\Schema;

interface GroupInterface extends ElementInterface
{
    /**
     * @return ElementInterface[]
     */
    public function elements(): array;

    /**
     * @param string $name
     * @return ElementInterface
     */
    public function get(string $name): ElementInterface;

    /**
     * @param array $elements
     * @return ElementInterface
     */
    public function withElements(array $elements): ElementInterface;
}
