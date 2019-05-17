<?php
declare(strict_types=1);

namespace Ixocreate\Schema\Link;

use Ixocreate\Application\Configurator\ConfiguratorInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Application\Service\SubManagerConfigurator;
use Ixocreate\ServiceManager\Factory\AutowireFactory;

final class LinkConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * LinkConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(LinkManager::class, LinkInterface::class);
    }

    /**
     * @param string $link
     * @param string $factory
     */
    public function addLink(string $link, string $factory = AutowireFactory::class): void
    {
        $this->subManagerConfigurator->addService($link, $factory);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addLinkDirectory(string $directory, bool $recursive = true): void
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $this->subManagerConfigurator->registerService($serviceRegistry);
    }
}
