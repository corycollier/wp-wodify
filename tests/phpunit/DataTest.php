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
    public function testSetApi()
    {
        $expected = new Api;
        $sut = new Data;
        $result = $sut->setApi($expected);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Data', 'api');
        $property->setAccessible(true);
        $result = $property->getValue($sut);
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::getApi
     */
    public function testGetApi()
    {
        $expected = new Api;
        $sut = new Data;

        $property = new \ReflectionProperty('\WpWodify\Data', 'api');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->getApi();
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Cache::set
     */
    public function testSetCache()
    {
        $expected = new Cache;
        $sut = new Data;
        $result = $sut->setCache($expected);
        $this->assertSame($sut, $result);

        $property = new \ReflectionProperty('\WpWodify\Data', 'cache');
        $property->setAccessible(true);
        $result = $property->getValue($sut);
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::getCache
     */
    public function testGetCache()
    {
        $expected = new Cache;
        $sut = new Data;

        $property = new \ReflectionProperty('\WpWodify\Data', 'cache');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);
        $result = $sut->getCache();
        $this->assertSame($expected, $result);
    }

    /**
     * Tests WpWodify\Data::get.
     *
     * @dataProvider provideGet
     */
    public function testGet($expected, $name, $params = array(), $cache = false)
    {
        $cacheId = 'cache-id';
        $sut = $this->getMockBuilder('\WpWodify\Data')
            ->setMethods(array('getCache', 'getApi'))
            ->getMock();

        $cacheObject = $this->getMockBuilder('\WpWodify\Cache')
            ->setMethods(array('get', 'set', 'createIdentifier'))
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
            ->method('createIdentifier')
            ->with($this->equalTo(array_merge($params, array(
                'api_name' => $name,
            ))))
            ->will($this->returnValue($cacheId));

        $cacheObject->expects($this->once())
            ->method('get')
            ->with($this->equalTo($cacheId))
            ->will($this->returnValue($cache));

        $sut->expects($this->once())
            ->method('getCache')
            ->will($this->returnValue($cacheObject));

        $sut->expects($this->once())
            ->method('getApi')
            ->will($this->returnValue($api));

        $result = $sut->get($name, $params);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGet.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGet()
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
