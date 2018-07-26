<?php
namespace KiwiSuite\Schema;

/** @var ElementConfigurator $element */
use KiwiSuite\Schema\Elements\BlockContainerElement;
use KiwiSuite\Schema\Elements\CheckboxElement;
use KiwiSuite\Schema\Elements\CollectionContainerElement;
use KiwiSuite\Schema\Elements\CollectionElement;
use KiwiSuite\Schema\Elements\ColorElement;
use KiwiSuite\Schema\Elements\DateElement;
use KiwiSuite\Schema\Elements\DateTimeElement;
use KiwiSuite\Schema\Elements\GroupElement;
use KiwiSuite\Schema\Elements\HtmlElement;
use KiwiSuite\Schema\Elements\ImageElement;
use KiwiSuite\Schema\Elements\LinkElement;
use KiwiSuite\Schema\Elements\MultiCheckboxElement;
use KiwiSuite\Schema\Elements\MultiSelectElement;
use KiwiSuite\Schema\Elements\NumberElement;
use KiwiSuite\Schema\Elements\RadioElement;
use KiwiSuite\Schema\Elements\SectionElement;
use KiwiSuite\Schema\Elements\SelectElement;
use KiwiSuite\Schema\Elements\TabbedGroupElement;
use KiwiSuite\Schema\Elements\TextareaElement;
use KiwiSuite\Schema\Elements\TextElement;
use KiwiSuite\Schema\Elements\YouTubeElement;

$element->addElement(TextElement::class);
$element->addElement(TextareaElement::class);
$element->addElement(SelectElement::class);
$element->addElement(MultiSelectElement::class);
$element->addElement(RadioElement::class);
$element->addElement(NumberElement::class);
$element->addElement(MultiCheckboxElement::class);
$element->addElement(ImageElement::class);
$element->addElement(DateTimeElement::class);
$element->addElement(DateElement::class);
$element->addElement(ColorElement::class);
$element->addElement(SectionElement::class);
$element->addElement(GroupElement::class);
$element->addElement(LinkElement::class);
$element->addElement(HtmlElement::class);
$element->addElement(YouTubeElement::class);
$element->addElement(BlockContainerElement::class);
$element->addElement(TabbedGroupElement::class);
$element->addElement(CollectionElement::class);
$element->addElement(CheckboxElement::class);
