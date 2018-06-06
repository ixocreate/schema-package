<?php
declare(strict_types=1);

namespace KiwiSuite\Schema;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $serviceManager */

$serviceManager->addSubManager(ElementSubManager::class);

$serviceManager->addFactory(Builder::class);
