<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\TypeInterface;

final class TableElement extends AbstractSingleElement
{
    private $minCols = null;
    private $maxCols = null;
    private $minRows = null;
    private $maxRows = null;
    private $header = null;

    public function type(): string
    {
        return TypeInterface::TYPE_ARRAY;
    }

    public function inputType(): string
    {
        return 'table';
    }

    public static function serviceName(): string
    {
        return 'table';
    }

    public function withMinCols(int $minCols)
    {
        $element = clone $this;
        $element->minCols = $minCols;

        return $element;
    }

    public function withMaxCols(int $maxCols)
    {
        $element = clone $this;
        $element->maxCols = $maxCols;

        return $element;
    }

    public function withMinRows(int $rows)
    {
        $element = clone $this;
        $element->minRows = $rows;

        return $element;
    }

    public function withMaxRows(int $rows)
    {
        $element = clone $this;
        $element->maxRows = $rows;

        return $element;
    }

    public function withHeader(array $header)
    {
        $element = clone $this;
        $element->header = $header;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['minCols'] = $this->minCols;
        $array['maxCols'] = $this->maxCols;
        $array['minRows'] = $this->minRows;
        $array['maxRows'] = $this->maxRows;
        $array['header'] = $this->header;

        return $array;
    }
}
