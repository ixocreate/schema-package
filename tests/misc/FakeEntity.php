<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Misc\Schema;

use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\TextElement;
use Ixocreate\Schema\Schema;
use Ixocreate\Schema\SchemaAwareInterface;
use Ixocreate\Schema\SchemaInterface;

class FakeEntity implements SchemaAwareInterface
{
    private function __construct()
    {
    }

    public function schema(BuilderInterface $builder): SchemaInterface
    {
        return (new Schema())
            ->withAddedElement($builder->create(TextElement::serviceName(), 'test'));
    }
}
