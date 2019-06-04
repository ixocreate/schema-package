<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Link;

use Ixocreate\Application\Service\ServiceManagerConfig;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Schema\Link\ExternalLink;
use Ixocreate\Schema\Link\LinkConfigurator;
use Ixocreate\Schema\Link\LinkManager;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Link\LinkConfigurator
 */
class LinkConfiguratorTest extends TestCase
{
    public function testAddLink()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $configurator = new LinkConfigurator();
        $configurator->addLink(ExternalLink::class);
        $configurator->registerService($serviceRegistry);


        /** @var ServiceManagerConfig $serviceManagerConfig */
        $serviceManagerConfig = $collector[LinkManager::class . '::Config'];
        $this->assertArrayHasKey(ExternalLink::class, $serviceManagerConfig->getFactories());
    }

    public function testAddLinkDirectory()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $configurator = new LinkConfigurator();
        $configurator->addLinkDirectory(\getcwd() . '/src/Link');
        $configurator->registerService($serviceRegistry);


        /** @var ServiceManagerConfig $serviceManagerConfig */
        $serviceManagerConfig = $collector[LinkManager::class . '::Config'];
        $this->assertArrayHasKey(ExternalLink::class, $serviceManagerConfig->getFactories());
    }

    public function testRegisterServices()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $configurator = new LinkConfigurator();
        $configurator->registerService($serviceRegistry);

        $this->assertArrayHasKey(LinkManager::class . '::Config', $collector);
        $this->assertInstanceOf(ServiceManagerConfig::class, $collector[LinkManager::class . '::Config']);
    }
}
