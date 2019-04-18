<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package;

interface ElementProviderInterface
{
    public function provideElement(BuilderInterface $builder): ElementInterface;
}
