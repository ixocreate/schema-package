<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Ixocreate\Schema\Type\Factory\CollectionTypeFactory;
use Ixocreate\Schema\Type\Factory\SchemaTypeFactory;

/** @var TypeConfigurator $type */
$type->addType(EmailType::class);
$type->addType(ColorType::class);
$type->addType(UuidType::class);
$type->addType(DateTimeType::class);
$type->addType(DateType::class);
$type->addType(LinkType::class);
$type->addType(HtmlType::class);
$type->addType(YouTubeType::class);
$type->addType(VimeoType::class);
$type->addType(PriceType::class);
$type->addType(MapType::class);
$type->addType(SchemaType::class, SchemaTypeFactory::class);
$type->addType(CollectionType::class, CollectionTypeFactory::class);
