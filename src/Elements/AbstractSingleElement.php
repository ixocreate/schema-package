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

namespace Ixocreate\Schema\Elements;

use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\SingleElementInterface;

abstract class AbstractSingleElement extends AbstractElement implements SingleElementInterface
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var bool
     */
    protected $disabled = false;

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
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
     * @param bool $disabled
     * @return ElementInterface
     */
    public function withDisabled(bool $disabled): ElementInterface
    {
        $element = clone $this;
        $element->disabled = $disabled;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['required'] = $this->isRequired();
        $array['disabled'] = $this->isDisabled();

        return $array;
    }
}
