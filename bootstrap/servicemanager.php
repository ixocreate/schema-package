<?php
declare(strict_types=1);

namespace KiwiSuite\Schema;

use KiwiSuite\Schema\AdditionalSchema\AdditionalSchemaSubManager;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $serviceManager */

$serviceManager->addSubManager(ElementSubManager::class);
$serviceManager->addSubManager(AdditionalSchemaSubManager::class);

$serviceManager->addFactory(Builder::class);
