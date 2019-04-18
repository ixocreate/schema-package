<?php
declare(strict_types=1);

namespace Ixocreate\Package\Schema;

use Ixocreate\Package\Schema\AdditionalSchema\AdditionalSchemaSubManager;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */

$serviceManager->addSubManager(ElementSubManager::class);
$serviceManager->addSubManager(AdditionalSchemaSubManager::class);

$serviceManager->addFactory(Builder::class);
