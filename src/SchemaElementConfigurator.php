<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Application\Service\SubManagerConfigurator;
use Ixocreate\ServiceManager\Factory\AutowireFactory;

final class SchemaElementConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * MiddlewareConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(ElementSubManager::class, ElementInterface::class);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addDirectory(string $directory, bool $recursive = true): void
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param string $element
     * @param string $factory
     */
    public function addElement(string $element, string $factory = AutowireFactory::class): void
    {
        $this->subManagerConfigurator->addFactory($element, $factory);
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
