<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTL\Symfony\Form\DataTransformer;

use DTL\Symfony\Form\DataTransformer\ArrayToDelimitedStringTransformer;

class ArrayToDelimitedStringTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function provideReverseTransform()
    {
        return array(
            array(
                'foo,bar,foo',
                array('foo', 'bar', 'foo')
            ),
            array(
                'foo',
                array('foo'),
                ',',
            ),
            array(
                '',
                array()
            ),
            array(
                'bar  , foo,       bat',
                array('bar', 'foo', 'bat')
            ),
            array(
                'bar,foo,bat',
                array('bar,foo,bat'),
                ':',
            ),
            array(
                null,
                array(),
            ),
            array(
                array('thisisanarray'),
                null,
                null,
                'Expected a string',
            ),
        );
    }

    /**
     * @dataProvider provideReverseTransform
     */
    public function testReverseTransform($string, $expected, $delimiter = ',', $expectedException = null)
    {
        if ($expectedException) {
            $this->setExpectedException('Symfony\Component\Form\Exception\TransformationFailedException', $expectedException);
        }

        $transformer = new ArrayToDelimitedStringTransformer($delimiter);
        $res = $transformer->reverseTransform($string);
        $this->assertEquals($expected, $res);
    }

    public function provideTransform()
    {
        return array(
            array(
                array('foo', 'bar', 'foo'),
                'foo ,bar ,foo',
                ',',
                0 , 1
            ),
            array(
                array('foo', 'bar', 'foo'),
                'foo,bar,foo',
                ',',
                0, 0
            ),
            array(
                array('foo', 'bar', 'foo'),
                'foo , bar , foo',
                ',',
                1, 1
            ),
            array(
                array('foo'),
                'foo',
                ',',
            ),
            array(
                null,
                '',
            ),
            array(
                'asdasd',
                null,
                null,
                null,
                null,
                'Expected an array',
            ),
        );
    }

    /**
     * @dataProvider provideTransform
     */
    public function testTransform($array, $string, $delimiter = null, $paddingLeft = null, $paddingRight = null, $expectedException = null)
    {
        if ($expectedException) {
            $this->setExpectedException('Symfony\Component\Form\Exception\TransformationFailedException', $expectedException);
        }

        $transformer = new ArrayToDelimitedStringTransformer($delimiter, $paddingLeft, $paddingRight);
        $res = $transformer->transform($array);
        $this->assertEquals($string, $res);
    }
}

