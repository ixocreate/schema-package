<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Configurator\ConfiguratorInterface;

final class SchemaElementBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new SchemaElementConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'element';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'schema-element.php';
    }
}
