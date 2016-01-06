<?php
/**
 * Class to test the WpWodify\Pages object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Pages object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class PagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests WpWodify\Pages::set_template
     */
    public function test_set_template()
    {
        $expected = 'expected';
        $sut = new Pages;
        $result = $sut->set_template($expected);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Pages', 'template');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals($expected, $result);

    }

    /**
     * Tests WpWodify\Pages::get_template
     */
    public function test_get_template()
    {
        $expected = 'expected';
        $sut = new Pages;

        $property = new \ReflectionProperty('\WpWodify\Pages', 'template');
        $property->setAccessible(true);
        $result = $property->setValue($sut, $expected);

        $result = $sut->get_template($expected);
        $this->assertEquals($expected, $result);

    }

    /**
     * Tests WpWodify\Pages::admin_settings
     */
    public function test_admin_settings()
    {
        $sut = $this->getMockBuilder('\WpWodify\Pages')
            ->setMethods(array('get_template'))
            ->getMock();

        $template = $this->getMockBuilder('\WpWodify\Template')
            ->setMethods(array('set_script', 'render'))
            ->getMock();

        $template->expects($this->once())->method('render');
        $template->expects($this->once())
            ->method('set_script')
            ->with($this->equalTo('admin-settings-template.php'));

        $sut->expects($this->once())
            ->method('get_template')
            ->will($this->returnValue($template));

        $sut->admin_settings();

    }
}