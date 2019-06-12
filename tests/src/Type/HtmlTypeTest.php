<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Ixocreate\Schema\Type\HtmlType;
use PHPUnit\Framework\TestCase;

class HtmlTypeTest extends TestCase
{
    /**
     * @covers \Ixocreate\Schema\Type\HtmlType
     */
    public function testStringTransform()
    {
        $type = new HtmlType();

        $html = '<h1>Lorem ipsum dolor sit amet consectetuer adipiscing elit</h1>';
        $type = $type->create($html);

        $this->assertSame(['html' => $html, 'quill' => null], $type->value());
    }

    public function testArrayTransform()
    {
        $type = new HtmlType();

        $value = [
            'html' => '<h1>Lorem ipsum dolor sit amet consectetuer adipiscing elit</h1>',
        ];
        $type = $type->create($value);
        $this->assertSame(['html' => '', 'quill' => null], $type->value());

        $value = [
            'quill' => '[]',
        ];
        $type = $type->create($value);
        $this->assertSame(['html' => '', 'quill' => null], $type->value());

        $value = [
            'html' => '<h1>Lorem ipsum dolor sit amet consectetuer adipiscing elit</h1>',
            'quill' => [],
        ];
        $type = $type->create($value);
        $this->assertSame($value, $type->value());
    }

    public function testDefaultTransform()
    {
        $type = new HtmlType();
        $type = $type->create(null);

        $this->assertSame(['html' => '', 'quill' => null], $type->value());
    }

    public function testTransformTypeChecks()
    {
        $type = new HtmlType();
        $type = $type->create(['html' => [], 'quill' => 'string']);
        
        $this->assertSame(['html' => '', 'quill' => null], $type->value());
    }

    public function testToStringEmptyValue()
    {
        $type = new HtmlType();
        $this->assertSame('', $type->__toString());
    }

    public function testToStringEmptyQuill()
    {
        $html = '<h1>Lorem ipsum dolor sit amet consectetuer adipiscing elit</h1>';

        $type = new HtmlType();
        $type = $type->create($html);

        $this->assertSame($html, $type->__toString());
    }

    public function testToQuillEncoding()
    {
        $type = new HtmlType();

        $value = [
            'html' => "<p>Lorem ipsum &lt;&gt;&amp; &quot;&#039;</p>",
            'quill' => \json_decode('{"ops":[{"insert":"Lorem ipsum <>& \"\'\n"}]}', true),
        ];

        $type = $type->create($value);

        $this->assertSame($value['html'], $type->__toString());
    }

    /**
     * @dataProvider quillDeltaDataProvider
     * @param mixed $delta
     * @param mixed $html
     */
    public function testToStringQuill($delta, $html)
    {
        $type = new HtmlType();

        $value = [
            'html' => '',
            'quill' => \json_decode($delta, true),
        ];

        $type = $type->create($value);

        $this->assertSame($html, $type->__toString());
    }

    public function quillDeltaDataProvider()
    {
        $deltas = [];
        $deltas[] = [
            '{"ops":[{"insert":"Lorem ipsum\n"}]}',
            '<p>Lorem ipsum</p>',
        ];
        $deltas[] = [
            '{"ops":[{"attributes":{"bold":true},"insert":"Bold"},{"insert":"\n"},{"attributes":{"italic":true},"insert":"Italic"},{"insert":"\n"},{"attributes":{"underline":true},"insert":"Underline"},{"insert":"\n"}]}',
            '<p><b>Bold</b></p><p><i>Italic</i></p><p><u>Underline</u></p>',
        ];
        // $deltas[] = [
        //     '{"ops":[{"attributes":{"strike":true},"insert":"strike"},{"insert":"\n"}]}',
        //     '<p><s>strike</s></p>',
        // ];
        $deltas[] = [
            '{"ops":[{"insert":"Heading 1"},{"attributes":{"header":1},"insert":"\n"},{"insert":"Heading 2"},{"attributes":{"header":2},"insert":"\n"},{"insert":"Heading 3"},{"attributes":{"header":3},"insert":"\n"},{"insert":"Heading 4"},{"attributes":{"header":4},"insert":"\n"},{"insert":"Heading 5"},{"attributes":{"header":5},"insert":"\n"},{"insert":"Heading 6"},{"attributes":{"header":6},"insert":"\n"},{"insert":"normal\n"}]}',
            '<h1>Heading 1</h1><h2>Heading 2</h2><h3>Heading 3</h3><h4>Heading 4</h4><h5>Heading 5</h5><h6>Heading 6</h6><p>normal</p>',
        ];
        // $deltas[] = [
        //     '{"ops":[{"insert":"text"},{"attributes":{"script":"super"},"insert":"upper"},{"insert":"\ntext"},{"attributes":{"script":"sub"},"insert":"lower"},{"insert":"\n"}]}',
        //     '<p>text<sup>upper</sup></p><p>text<sub>lower</sub></p>',
        // ];
        $deltas[] = [
            '{"ops":[{"insert":"item 1"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"item 2"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"item 3"},{"attributes":{"list":"ordered"},"insert":"\n"}]}',
            '<ol><li>item 1</li><li>item 2</li><li>item 3</li></ol>',
        ];
        $deltas[] = [
            '{"ops":[{"insert":"item 1"},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"item 2"},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"item 3"},{"attributes":{"list":"bullet"},"insert":"\n"}]}',
            '<ul><li>item 1</li><li>item 2</li><li>item 3</li></ul>',
        ];
        // $deltas[] = [
        //     '{"ops":[{"insert":"Normal Text\nCentered Text"},{"attributes":{"align":"center"},"insert":"\n"},{"insert":"Right Text"},{"attributes":{"align":"right"},"insert":"\n"}]}',
        //     '<p>Normal Text</p><p class="ql-align-center">Centered Text</p><p class="ql-align-right">Right Text</p>',
        // ];
        // $deltas[] = [
        //     '{"ops":[{"insert":"Text Block"},{"attributes":{"align":"justify"},"insert":"\n"}]}',
        //     '<p class="ql-align-justify">Text Block</p>',
        // ];
        // $deltas[] = [
        //     '{"ops":[{"attributes":{"bold":true},"insert":"bold"},{"attributes":{"list":"ordered"},"insert":"\n"},{"attributes":{"italic":true},"insert":"italic"},{"attributes":{"list":"ordered"},"insert":"\n"},{"attributes":{"underline":true},"insert":"underline"},{"attributes":{"list":"ordered"},"insert":"\n"},{"attributes":{"strike":true},"insert":"strike"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"\nnormal Text\n"}]}',
        //     '<ol><li><strong>bold</strong></li><li><em>italic</em></li><li><u>underline</u></li><li><s>strike</s></li></ol><p><br></p><p>normal Text</p>',
        // ];

        // TODO: ixolink, text intent

//        $deltas[] = [
//            '',
//            ''
//        ];

        return $deltas;
    }

    public function testBaseDatabaseType()
    {
        $this->assertSame(JsonType::class, HtmlType::baseDatabaseType());
    }

    public function testServiceName()
    {
        $this->assertSame('html', HtmlType::serviceName());
    }
}
