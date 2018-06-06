<?php
namespace KiwiSuite\Schema;

/** @var ElementConfigurator $element */
use KiwiSuite\Schema\Elements\SegmentGroupElement;
use KiwiSuite\Schema\Elements\TabbedGroupElement;

$element->addElement(SegmentGroupElement::class);
$element->addElement(TabbedGroupElement::class);
