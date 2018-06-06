<?php
namespace KiwiSuite\Schema;

final class Builder
{
    /**
     * @var ElementSubManager
     */
    private $elementSubManager;

    /**
     * Builder constructor.
     * @param ElementSubManager $elementSubManager
     */
    public function __construct(ElementSubManager $elementSubManager)
    {
        $this->elementSubManager = $elementSubManager;
    }

    /**
     * @param string $element
     * @param string $name
     * @return ElementInterface
     */
    public function create(string $element, string $name): ElementInterface
    {
        /** @var ElementInterface $element */
        $element = $this->elementSubManager->get($element);
        return $element->withName($name);
    }
}
