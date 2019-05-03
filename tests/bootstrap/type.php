<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Misc\Schema\Type\MockType;

/** @var ServiceManagerConfigurator $typeConfigurator */
$typeConfigurator->addFactory(MockType::class);
