<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Misc\Schema\Type\MockType;

/** @var ServiceManagerConfigurator $typeConfigurator */
$typeConfigurator->addFactory(MockType::class);
