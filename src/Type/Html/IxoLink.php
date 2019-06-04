<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type\Html;

use Ixocreate\QuillRenderer\Delta;
use Ixocreate\QuillRenderer\Insert\InsertInterface;
use Ixocreate\Schema\Type\LinkType;
use Ixocreate\Schema\Type\Type;

final class IxoLink implements InsertInterface
{
    /**
     * @var InsertInterface
     */
    private $insert;

    /**
     * @var Delta
     */
    private $delta;

    /**
     * @param InsertInterface $insert
     * @return InsertInterface
     */
    public function withInsert(InsertInterface $insert): InsertInterface
    {
        $item = clone $this;
        $item->insert = $insert;

        return $item;
    }

    /**
     * @param Delta $delta
     * @return bool
     */
    public function isResponsible(Delta $delta): bool
    {
        return
            \is_array($delta->attributes([]))
            && \array_key_exists('ixolink', $delta->attributes([]))
            && \is_array($delta->attributes([])['ixolink'])
            ;
    }

    /**
     * @return string
     */
    public function html(): string
    {
        if (empty($this->insert)) {
            return '';
        }

        $link = $this->delta->attributes([]);
        if (empty($link)) {
            return '';
        }

        if (!\array_key_exists('ixolink', $link)) {
            return '';
        }

        if (empty($link['ixolink'])) {
            return '';
        }

        /** @var LinkType $link */
        $link = Type::create($link['ixolink'], LinkType::serviceName());

        return \sprintf('<a href="%s" target="%s">%s</a>', (string) $link, $link->target(), $this->insert->html());
    }

    /**
     * @param Delta $delta
     * @return InsertInterface
     */
    public function withDelta(Delta $delta): InsertInterface
    {
        $item = clone $this;
        $item->delta = $delta;

        return $item;
    }
}
