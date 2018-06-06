<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Schema\ElementInterface;
use KiwiSuite\Schema\SingleElementInterface;

abstract class AbstractSingleElement extends AbstractElement implements SingleElementInterface
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @return bool
     */
    public function required(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return ElementInterface
     */
    public function withRequired(bool $required): ElementInterface
    {
        $element = clone $this;
        $element->required = $required;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['required'] = $this->required;

        return $array;
    }
}
