<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Application\Package\BootInterface;
use Ixocreate\Application\Package\PackageInterface;
use Ixocreate\Schema\Element\ElementBootstrapItem;
use Ixocreate\Schema\Link\LinkBootstrapItem;
use Ixocreate\Schema\Type\Type;
use Ixocreate\Schema\Type\TypeBootstrapItem;
use Ixocreate\Schema\Type\TypeSubManager;
use Ixocreate\ServiceManager\ServiceManagerInterface;

final class Package implements PackageInterface, BootInterface
{
    /**
     * @return array
     */
    public function getBootstrapItems(): array
    {
        return [
            TypeBootstrapItem::class,
            ElementBootstrapItem::class,
            LinkBootstrapItem::class,
        ];
    }

    /**
     * @param ServiceManagerInterface $serviceManager
     */
    public function boot(ServiceManagerInterface $serviceManager): void
    {
        Type::initialize($serviceManager->get(TypeSubManager::class));
    }

    /**
     * @return null|string
     */
    public function getBootstrapDirectory(): ?string
    {
        return __DIR__ . '/../bootstrap';
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [];
    }
}
