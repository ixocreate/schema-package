<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Ixocreate\QuillRenderer\Renderer;
use Ixocreate\Schema\Type\Html\IxoLink;

final class HtmlType extends AbstractType implements DatabaseTypeInterface
{
    /**
     * @param $value
     * @return array
     */
    protected function transform($value)
    {
        if (\is_string($value)) {
            return [
                'html' => $value,
                'quill' => null,
            ];
        }

        if (\is_array($value) && \array_key_exists("html", $value) && \array_key_exists("quill", $value)) {
            return [
                'html' => $value['html'],
                'quill' => $value['quill'],
            ];
        }

        return [
            'html' => '',
            'quill' => null,
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (empty($this->value())) {
            return '';
        }

        if ($this->value()['quill'] === null) {
            return $this->value()['html'];
        }

        $renderer = new Renderer();
        $renderer->enableDefaults();
        $renderer->addInsert(new IxoLink());

        return $renderer->render($this->value()['quill']);
    }

    /**
     * @return string
     */
    public function convertToDatabaseValue()
    {
        return $this->value();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return JsonType::class;
    }

    public static function serviceName(): string
    {
        return 'html';
    }
}
