<?php
/**
 * Class to test the WpWodify\Overlord object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Overlord object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class OverlordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests WpWodify\Overlord::get_instance
     */
    public function test_get_instance()
    {
        $result = Overlord::get_instance();
        $this->assertInstanceOf('\WpWodify\Overlord', $result);

        $property = new \ReflectionProperty('WpWodify\Overlord', 'instance');
        $property->setAccessible(true);
        $property->setValue($result, null);
        $result = Overlord::get_instance();
    }

    /**
     * Tests WpWodify\Ovelord::get_loader
     */
    public function test_get_loader()
    {
        $sut = Overlord::get_instance();
        $expected = 'expected object';

        $property = new \ReflectionProperty('\WpWodify\Overlord', 'loader');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);

        $result = $sut->get_loader();
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Ovelord::set_loader
     */
    public function test_set_loader()
    {
        $sut = Overlord::get_instance();
        $expected = 'expected object';
        $result = $sut->set_loader($expected);

        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Overlord', 'loader');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Overlord::define_admin_hooks
     */
    public function test_define_admin_hooks()
    {
        $sut = Overlord::get_instance();
        $result = $sut->define_admin_hooks();
        $this->assertSame($sut, $result);

        \Patchwork\replace('is_admin', function() {
            return true;
        });

        $result = $sut->define_admin_hooks();
        $this->assertSame($sut, $result);
    }

    /**
     * Tests WpWodify\Overlord::define_public_hooks
     */
    public function test_define_public_hooks()
    {
        $sut = Overlord::get_instance();
        $result = $sut->define_public_hooks();
        $this->assertSame($sut, $result);
    }

    /**
     * Tests WpWodify\Overlord::register_settings
     */
    public function test_register_settings()
    {
        \Patchwork\replace('register_setting', function($arg1, $arg2) {

        });
        $sut = Overlord::get_instance();
        $result = $sut->register_settings();
        $this->assertSame($sut, $result);
    }

    /**
     * Tests the WpWodify\Overlord::run method
     */
    public function test_run()
    {
        $sut = $this->getMockBuilder('\WpWodify\Overlord')
            ->disableOriginalConstructor()
            ->setMethods(['define_admin_hooks', 'define_public_hooks', 'register_settings'])
            ->getMock();

        $sut->expects($this->once())->method('define_admin_hooks');
        $sut->expects($this->once())->method('define_public_hooks');
        $sut->expects($this->once())->method('register_settings');

        $result = $sut->run();
        // $this->assertEquals($sut, $result);
    }
}
