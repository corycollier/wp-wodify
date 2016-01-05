<?php
/**
 * Class to test the WpWodify\Data object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

use WpWodify\Data as Data;

/**
 * Class to test the WpWodify\Data object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests WpWodify\Data::set
     */
    public function test_set_api()
    {
        $expected = new Api;
        $sut = new Data;
        $result = $sut->set_api($expected);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Data', 'api');
        $property->setAccessible(true);
        $result = $property->getValue($sut);
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::get_api
     */
    public function test_get_api()
    {
        $expected = new Api;
        $sut = new Data;

        $property = new \ReflectionProperty('\WpWodify\Data', 'api');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->get_api();
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Cache::set
     */
    public function test_set_cache()
    {
        $expected = new Cache;
        $sut = new Data;
        $result = $sut->set_cache($expected);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Data', 'cache');
        $property->setAccessible(true);
        $result = $property->getValue($sut);
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::get_cache
     */
    public function test_get_cache()
    {
        $expected = new Cache;
        $sut = new Data;

        $property = new \ReflectionProperty('\WpWodify\Data', 'cache');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->get_cache();
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::get.
     *
     * @dataProvider provide_get
     */
    public function test_get($expected, $name, $params = array(), $cache = false)
    {
        $cacheId = 'cache-id';
        $sut = $this->getMockBuilder('\WpWodify\Data')
            ->setMethods(array('get_cache', 'get_api'))
            ->getMock();

        $cacheObject = $this->getMockBuilder('\WpWodify\Cache')
            ->setMethods(array('get', 'set', 'create_identifier'))
            ->getMock();

        $api = $this->getMockBuilder('\WpWodify\Api')
            ->setMethods(array('get'))
            ->getMock();

        if (! $cache) {
            $api->expects($this->once())
                ->method('get')
                ->with($this->equalTo($name), $this->equalTo($params))
                ->will($this->returnValue($expected));

            $cacheObject->expects($this->once())
                ->method('set')
                ->with($this->equalTo($cacheId), $this->equalTo($expected));
        }

        $cacheObject->expects($this->once())
            ->method('create_identifier')
            ->with($this->equalTo(array_merge($params, array(
                'api_name' => $name,
            ))))
            ->will($this->returnValue($cacheId));

        $cacheObject->expects($this->once())
            ->method('get')
            ->with($this->equalTo($cacheId))
            ->will($this->returnValue($cache));

        $sut->expects($this->once())
            ->method('get_cache')
            ->will($this->returnValue($cacheObject));

        $sut->expects($this->once())
            ->method('get_api')
            ->will($this->returnValue($api));

        $result = $sut->get($name, $params);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGet.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get()
    {
        return array(
            'cache has expected result' => array(
                'expected' => 'expected value',
                'name'     => 'some-name',
                'params'   => array(),
                'cache'    => 'expected value'
            ),

            'cache has nothing ' => array(
                'expected' => 'expected value',
                'name'     => 'some-name',
                'params'   => array(),
            ),
        );
    }
}
