<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Element\CheckboxElement;
use Ixocreate\Schema\Element\CollectionElement;
use Ixocreate\Schema\Element\ColorElement;
use Ixocreate\Schema\Element\DateElement;
use Ixocreate\Schema\Element\DateTimeElement;
use Ixocreate\Schema\Element\ElementConfigurator;
use Ixocreate\Schema\Element\GroupElement;
use Ixocreate\Schema\Element\HtmlElement;
use Ixocreate\Schema\Element\LinkElement;
use Ixocreate\Schema\Element\MapElement;
use Ixocreate\Schema\Element\MultiCheckboxElement;
use Ixocreate\Schema\Element\MultiSelectElement;
use Ixocreate\Schema\Element\NumberElement;
use Ixocreate\Schema\Element\PriceElement;
use Ixocreate\Schema\Element\RadioElement;
use Ixocreate\Schema\Element\SchemaElement;
use Ixocreate\Schema\Element\SectionElement;
use Ixocreate\Schema\Element\SelectElement;
use Ixocreate\Schema\Element\TabbedGroupElement;
use Ixocreate\Schema\Element\TableElement;
use Ixocreate\Schema\Element\TextareaElement;
use Ixocreate\Schema\Element\TextElement;
use Ixocreate\Schema\Element\VimeoElement;
use Ixocreate\Schema\Element\YouTubeElement;

/** @var ElementConfigurator $element */
$element->addElement(SchemaElement::class);
$element->addElement(TextElement::class);
$element->addElement(TextareaElement::class);
$element->addElement(SelectElement::class);
$element->addElement(MultiSelectElement::class);
$element->addElement(RadioElement::class);
$element->addElement(NumberElement::class);
$element->addElement(MultiCheckboxElement::class);
$element->addElement(DateTimeElement::class);
$element->addElement(DateElement::class);
$element->addElement(ColorElement::class);
$element->addElement(SectionElement::class);
$element->addElement(GroupElement::class);
$element->addElement(LinkElement::class);
$element->addElement(HtmlElement::class);
$element->addElement(YouTubeElement::class);
$element->addElement(VimeoElement::class);
$element->addElement(PriceElement::class);
$element->addElement(MapElement::class);
$element->addElement(TabbedGroupElement::class);
$element->addElement(CollectionElement::class);
$element->addElement(CheckboxElement::class);
$element->addElement(TableElement::class);
