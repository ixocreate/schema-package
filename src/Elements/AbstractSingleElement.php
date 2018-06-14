<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\SingleElementInterface;

abstract class AbstractSingleElement extends AbstractElement implements SingleElementInterface
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @return bool
     */
    public function isRequired(): bool
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
        $array['required'] = $this->isRequired();

        return $array;
    }
}
