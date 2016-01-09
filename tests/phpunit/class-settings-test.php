<?php
/**
 * Class to test the WpWodify\Settings object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Settings object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class SettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the ability to create an exception
     */
    public function test_constructor()
    {
        $expected = 'name';
        $sut = new Settings($expected);

        $property = new \ReflectionProperty('\WpWodify\Settings', 'name');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals($result, $expected);
    }

    /**
     * Tests WpWodify\Settings::add_section
     *
     * @dataProvider provide_add_section
     */
    public function test_add_section($callback, $name, $human, $slug)
    {
        $sut = $this->getMockBuilder('WpWodify\Settings')
            ->setConstructorArgs(array($name))
            ->setMethods(array('humanize', 'get_slug'))
            ->getMock();

        $sut->expects($this->once())
            ->method('get_slug')
            ->will($this->returnValue($slug));

        $sut->expects($this->once())
            ->method('humanize')
            ->will($this->returnValue($human));

        $result = $sut->add_section($callback);

        // $this->assertSame($sut, $result);
    }

    /**
     * Data Provider for test_add_section.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_add_section()
    {
        return array(
            array(
                'callback' => 'some callback value',
                'name'     => 'the name value',
                'human'    => 'the human value ;)',
                'slug'     => 'the slug (gross)',
            )
        );
    }

    /**
     * Tests the WpWodify\Settings::add_field method.
     *
     * @dataProvider provide_add_field
     */
    public function test_add_field($name, $callback)
    {
        // $title   = ucwords(strtr($name, array('-' => ' ')));
        // $section = $this->name;
        // $name    = $this->prefix . $name;
        // $slug    = $this->get_slug();

        // \add_settings_field($name, $title, $callback, $slug, $section);
        // return $this;

        $settingsName = 'SettingsName';
        $slug = 'slug';
        $sut = $this->getMockBuilder('WpWodify\Settings')
            ->setConstructorArgs(array($settingsName))
            ->setMethods(array('humanize', 'get_slug'))
            ->getMock();

        $sut->expects($this->once())
            ->method('get_slug')
            ->will($this->returnValue($slug));

        $result = $sut->add_field($name, $callback);
    }

    /**
     * Data Provider for test_add_field.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_add_field()
    {
        return array(
            array(
                'name' => 'the name value',
                'callback' => 'string callback',
            )
        );
    }

    /**
     * Tests WpWodify\Settings::register
     *
     * @dataProvider provide_register
     */
    public function test_register($name, $group)
    {
        $sut = new Settings('test');
        $result = $sut->register($name, $group);
        $this->assertSame($sut, $result);
    }

    /**
     * Data Provider for test_register.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_register()
    {
        return array(
            array(
                'name' => 'name value',
                'group' => 'group value',
            )
        );
    }

    /**
     * Tests WpWodify\Settings::humanize
     *
     * @dataProvider provide_humanize
     */
    public function test_humanize($expected, $value)
    {
        $sut = new Settings('test');

        $method = new \ReflectionMethod('WpWodify\Settings', 'humanize');
        $method->setAccessible(true);
        $result = $method->invoke($sut, $value);

        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for test_humanize.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_humanize()
    {
        return array(
            'dash test' => array(
                'expected' => 'The Value',
                'value'    => 'the-value',
            ),
            'dash test with leading dashes' => array(
                'expected' => 'The Value',
                'value'    => '-the-value',
            ),
            'dash test with trailing dashes' => array(
                'expected' => 'The Value',
                'value'    => 'the-value-',
            ),
            'underscore test' => array(
                'expected' => 'The Value',
                'value'    => 'the_value',
            ),
            'underscore test with leading underscores' => array(
                'expected' => 'The Value',
                'value'    => '_the_value',
            ),
            'underscore test with trailing underscores' => array(
                'expected' => 'The Value',
                'value'    => 'the_value_',
            ),
        );
    }

    /**
     * Tests WpWodify\Settings::machinify
     *
     * @dataProvider provide_machinify
     */
    public function test_machinify($expected, $string)
    {
        $sut = new Settings('test');

        $method = new \ReflectionMethod('\WpWodify\Settings', 'machinify');
        $method->setAccessible(true);
        $result = $method->invoke($sut, $string);

        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for test_machinify.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_machinify()
    {
        return array(
            'space test' => array(
                'expected' => 'the-expected-result',
                'string'   => 'The Expected Result',
            ),
            'space test with leading spaces' => array(
                'expected' => 'the-expected-result',
                'string'   => ' The Expected Result',
            ),
            'space test with trailing spaces' => array(
                'expected' => 'the-expected-result',
                'string'   => 'The Expected Result ',
            ),
            'comma test' => array(
                'expected' => 'the-expected-result',
                'string'   => 'The Expected, Result',
            ),
            'comma test, with leading commas' => array(
                'expected' => 'the-expected-result',
                'string'   => ',The Expected, Result',
            ),
            'comma test, with trailing commas' => array(
                'expected' => 'the-expected-result',
                'string'   => 'The Expected, Result,',
            ),
        );
    }


    /**
     * Tests WpWodify\Settings::get_slug
     *
     * @dataProvider provide_get_slug
     */
    public function test_get_slug($expected, $name)
    {
        $sut = new Settings($name);

        $method = new \ReflectionMethod('\WpWodify\Settings', 'get_slug');
        $method->setAccessible(true);
        $result = $method->invoke($sut);

        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for test_get_slug.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get_slug()
    {
        return array(
            array(
                'expected' => 'wp-wodify-name-settings',
                'name'     => 'name',
            )
        );
    }

}
