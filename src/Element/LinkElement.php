<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\LinkType;

final class LinkElement extends AbstractSingleElement
{
    private $allowedLinkTypes = null;

    public function type(): string
    {
        return LinkType::class;
    }

    public function inputType(): string
    {
        return 'link';
    }

    public static function serviceName(): string
    {
        return 'link';
    }

    public function withAllowedLinkTypes(array $allowedLinkTypes): LinkElement
    {
        $element = clone $this;
        $element->allowedLinkTypes = $allowedLinkTypes;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['required'] = $this->isRequired();
        $array['disabled'] = $this->isDisabled();
        $array['allowedLinkTypes'] = $this->allowedLinkTypes;

        return $array;
    }
}
