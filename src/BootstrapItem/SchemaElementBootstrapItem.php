<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Bootstrap;

use Ixocreate\Application\Service\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\Schema\ElementConfigurator;

final class SchemaElementBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new ElementConfigurator();
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
        return 'schema_element.php';
    }
}
