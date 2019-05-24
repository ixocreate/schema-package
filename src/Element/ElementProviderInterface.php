<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Builder\BuilderInterface;

interface ElementProviderInterface
{
    public function provideElement(BuilderInterface $builder): ElementInterface;
}
