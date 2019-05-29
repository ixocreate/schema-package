<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Schema\Builder\Builder;
use Ixocreate\Schema\Builder\BuilderFactory;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\ElementSubManager;
use Ixocreate\Schema\Link\LinkManager;
use Ixocreate\Schema\Type\TypeSubManager;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(ElementSubManager::class);
$serviceManager->addSubManager(SchemaSubManager::class);
$serviceManager->addSubManager(TypeSubManager::class);
$serviceManager->addSubManager(LinkManager::class);

$serviceManager->addFactory(BuilderInterface::class, BuilderFactory::class);
