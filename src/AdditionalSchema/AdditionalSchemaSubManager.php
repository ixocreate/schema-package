<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\AdditionalSchema;

use Ixocreate\Package\Schema\AdditionalSchemaInterface;
use Ixocreate\Package\Schema\BuilderInterface;
use Ixocreate\Package\Schema\SchemaInterface;
use Ixocreate\Package\Schema\SchemaProviderInterface;
use Ixocreate\ServiceManager\SubManager\SubManager;

class AdditionalSchemaSubManager extends SubManager implements SchemaProviderInterface
{
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        /** @var AdditionalSchemaInterface $additionalSchema */
        $additionalSchema = $this->get($name);

        return $additionalSchema->additionalSchema($builder);
    }
}
