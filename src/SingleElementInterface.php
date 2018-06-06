<?php
namespace KiwiSuite\Schema;

interface SingleElementInterface extends ElementInterface
{
    /**
     * @return bool
     */
    public function required(): bool;

    /**
     * @param bool $required
     * @return ElementInterface
     */
    public function withRequired(bool $required): ElementInterface;
}
