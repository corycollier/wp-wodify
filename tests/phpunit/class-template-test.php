<?php
/**
 * Class to test the WpWodify\Template object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Template object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests WpWodify\Template::set_template
     *
     * @dataProvider provide_set_template
     */
    public function test_set_template($name)
    {
        $sut = new Template;
        $result = $sut->set_template($name);
        $this->assertEquals($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Template', 'template');
        $property->setAccessible(true);
        $result = $property->getValue($sut);
        $this->assertEquals($name, $result);
    }

    /**
     * Data Provider for test_set_template.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_set_template()
    {
        return array(
            array(
                'name' => 'name',
            )
        );
    }

    /**
     * Tests WpWodify\Template::get_template.
     *
     * @dataProvider provide_get_template
     */
    public function test_get_template($name)
    {
        $sut = new Template;
        $property = new \ReflectionProperty('\WpWodify\Template', 'template');
        $property->setAccessible(true);
        $result = $property->setValue($sut, $name);
        $result = $sut->get_template($name);
        $this->assertEquals($name, $result);
    }

    /**
     * Data Provider for test_get_template.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get_template()
    {
        return array(
            array(
                'name' => 'name',
            )
        );
    }

    /**
     * Tests WpWodify\Template::set.
     *
     * @dataProvider provide_set
     */
    public function test_set($expected, $name, $value)
    {
        $sut = new Template;
        $result = $sut->set($name, $value);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Template', 'vars');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for test_set
     *
     * @return array An array of data to use for testing.
     */
    public function provide_set()
    {
        return array(
            array(
                'expected' => array('name' => 'value'),
                'name'     => 'name',
                'value'    => 'value',
            )
        );
    }

}
