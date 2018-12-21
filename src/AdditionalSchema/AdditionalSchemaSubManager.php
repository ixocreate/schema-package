<?php
declare(strict_types=1);

namespace KiwiSuite\Schema\AdditionalSchema;

use KiwiSuite\Contract\Schema\AdditionalSchemaInterface;
use KiwiSuite\Contract\Schema\SchemaInterface;
use KiwiSuite\Contract\Schema\SchemaReceiverInterface;
use KiwiSuite\Schema\Builder;
use KiwiSuite\ServiceManager\SubManager\SubManager;

class AdditionalSchemaSubManager extends SubManager implements SchemaReceiverInterface
{

    public function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        /** @var AdditionalSchemaInterface $additionalSchema */
        $additionalSchema = $this->get($options['additionalSchema']);

        return $additionalSchema->receiveSchema($builder);
    }
}