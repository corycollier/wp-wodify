<?php
/**
 * Class to test the WpWodify\Fields object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Fields object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FieldsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests WpWodify\Fields::get_input_field
     *
     * @dataProvider provide_get_input_field
     */
    public function test_get_input_field($expected, $replacements, $attribs)
    {
        $sut = $this->getMockBuilder('\WpWodify\Fields')
            ->setMethods(array('get_attribs'))
            ->getMock();

        $sut->expects($this->once())
            ->method('get_attribs')
            ->will($this->returnValue(''));

        $result = $sut->get_input_field($replacements);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for test_get_input_field.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get_input_field()
    {
        return array(
            'empty replacements' => array(
                'expected' => '<input type="text" name="" value=""  />',
                'replacements' => array(

                ),
                'attribs' => array(

                ),
            )
        );
    }

    /**
     * Tests WpWodify\Fields::input_field
     *
     * @dataProvider provide_input_field
     */
    public function test_input_field($expected, $replacements)
    {
        $sut = $this->getMockBuilder('\WpWodify\Fields')
            ->setMethods(array('get_input_field'))
            ->getMock();

        $sut->expects($this->once())
            ->method('get_input_field')
            ->with($this->equalTo($replacements))
            ->will($this->returnValue($expected));

        $this->expectOutputString($expected);
        $sut->input_field($replacements);
    }

    /**
     * Data Provider for test_input_field.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_input_field()
    {
        return array(
            'empty replacements' => array(
                'expected' => '<input type="text" name="" value=""  />',
                'replacements' => array(

                ),
            )
        );
    }

    /**
     * Tests WpWodify\Fields::get_attribs
     *
     * @dataProvider provide_get_attribs
     */
    public function test_get_attribs($expected, $attribs)
    {
        $sut = new Fields;

        $method = new \ReflectionMethod('\WpWodify\Fields', 'get_attribs');
        $method->setAccessible(true);
        $result = $method->invoke($sut, $attribs);

        $this->assertEquals($expected, $result);

    }

    /**
     * Data Provider for test_get_attribs.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get_attribs()
    {
        return array(
            'empty array' => array(
                'expected' => '',
                'attribs' => array(),
            ),

            'single attrib' => array(
                'expected' => 'key="value"',
                'attribs' => array(
                    'key' => 'value',
                ),
            ),

            'two attribs' => array(
                'expected' => 'key1="value1" key2="value2"',
                'attribs' => array(
                    'key1' => 'value1',
                    'key2' => 'value2',
                ),
            ),

            'nested array attribs' => array(
                'expected' => 'key1="value1" key2="value2" key3="nestedvalue1,nestedvalue2,nestedvalue3"',
                'attribs' => array(
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => array(
                        'name1' => 'nestedvalue1',
                        'name2' => 'nestedvalue2',
                        'name3' => 'nestedvalue3',
                    )
                ),
            ),
        );
    }


}
