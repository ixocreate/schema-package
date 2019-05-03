<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Builder;

use Ixocreate\Schema\Element\ElementInterface;

interface BuilderInterface
{
    /**
     * @param string $element
     * @param string $name
     * @return ElementInterface
     */
    public function create(string $element, string $name): ElementInterface;

    /**
     * @param string $element
     * @return ElementInterface
     */
    public function get(string $element): ElementInterface;
}
