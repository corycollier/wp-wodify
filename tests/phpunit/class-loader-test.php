<?php
/**
 * Class to test the WpWodify\Loader object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Loader object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the ability to create an exception
     */
    public function test_constructor()
    {
        $exception = new Loader;
        $this->assertInstanceOf('\WpWodify\Loader', $exception);
    }

    /**
     * Tests WpWodify\Loader::add_action
     */
    public function test_add_action()
    {
        $expected = array('stuff');
        $sut = $this->getMockBuilder('\WpWodify\Loader')
            ->disableOriginalConstructor()
            ->setMethods(array('componentify'))
            ->getMock();

        $sut->expects($this->once())
            ->method('componentify')
            ->with($this->equalTo('hook'), $this->equalTo('component'), $this->equalTo('callback'))
            ->will($this->returnValue($expected));

        $result = $sut->add_action('hook', 'component', 'callback');

        $property = new \ReflectionProperty('\WpWodify\Loader', 'actions');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals(array($expected), $result);
    }

    /**
     * Tests WpWodify\Loader::get_action
     */
    public function test_get_actions()
    {
        $sut      = new Loader;
        $expected = array(array('stuff'));
        $property = new \ReflectionProperty('\WpWodify\Loader', 'actions');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->get_actions();
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests WpWodify\Loader::add_filter
     */
    public function test_add_filter()
    {
        $expected = array('stuff');
        $sut = $this->getMockBuilder('\WpWodify\Loader')
            ->disableOriginalConstructor()
            ->setMethods(array('componentify'))
            ->getMock();

        $sut->expects($this->once())
            ->method('componentify')
            ->with($this->equalTo('hook'), $this->equalTo('component'), $this->equalTo('callback'))
            ->will($this->returnValue($expected));

        $result = $sut->add_filter('hook', 'component', 'callback');

        $property = new \ReflectionProperty('\WpWodify\Loader', 'filters');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals(array($expected), $result);
    }

    /**
     * Tests WpWodify\Loader::get_action
     */
    public function test_get_filters()
    {
        $sut      = new Loader;
        $expected = array(array('stuff'));
        $property = new \ReflectionProperty('\WpWodify\Loader', 'filters');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->get_filters();
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests WpWodify\Loader::componentify
     *
     * @dataProvider provide_componentify
     */
    public function test_componentify($expected, $hook, $component, $callback)
    {
        $sut = new Loader;
        $method = new \ReflectionMethod('\WpWodify\Loader', 'componentify');
        $method->setAccessible(true);
        $result = $method->invoke($sut, $hook, $component, $callback);
        $this->assertEquals($expected, $result);
    }

    public function provide_componentify()
    {
        return array(
            array(
                'expected' => array(
                    'hook'          => 'hook',
                    'function'      => array('component', 'callback'),
                    'priority'      => 10,
                    'accepted_args' => 1,
                ),
                'hook'      => 'hook',
                'component' => 'component',
                'callback'  => 'callback',
            )
        );
    }
}
