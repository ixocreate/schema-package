<?php
declare(strict_types=1);

namespace Ixocreate\Schema\Link;

use Ixocreate\ServiceManager\NamedServiceInterface;

interface LinkInterface extends \Serializable, NamedServiceInterface
{
    /**
     * @param $value
     * @return LinkInterface
     */
    public function create($value): LinkInterface;

    /**
     * @return string
     */
    public function label(): string;

    /**
     * @return string
     */
    public function assemble(): string;

    /**
     * @return mixed
     */
    public function toJson();

    /**
     * @return mixed
     */
    public function toDatabase();

}
