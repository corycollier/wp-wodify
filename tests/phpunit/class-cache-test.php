<?php
/**
 * Class to test the WpWodify\Cache object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

use WpWodify\Cache as Cache;

/**
 * Class to test the WpWodify\Cache object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class CacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the WpWodify\Cache::get method.
     *
     * @dataProvider provideGet
     */
    public function testGet($expected, $name)
    {
        $sut = new Cache;
        $result = $sut->get($name);
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
            array(
                'expected' => '',
                'name'     => 'cache-name',
            ),
        );
    }

    /**
     * Tests WpWodify\Cache::set.
     *
     * @dataProvider provideSet
     */
    public function testSet($name, $data)
    {
        $sut = new Cache;
        $result = $sut->set($name, $data);
        $this->assertSame($sut, $result);
    }

    /**
     * Data provider for testSet.
     *
     * @return array An array of data to use for testing.
     */
    public function provideSet()
    {
        return array(
            array(
                'name' => 'cache-name',
                'data' => 'cache-value',
            ),
        );
    }

    /**
     * Tests WpWodify\Cache::create_identifier.
     *
     * @dataProvider provide_create_identifier
     */
    public function test_create_identifier($expected, $params)
    {
        $sut = new Cache;
        $result = $sut->create_identifier($params);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testCreateIdentifier.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_create_identifier()
    {
        return array(
            array(
                'expected' => 'param1-value1-param2-value2',
                'params' => array(
                    'param1' => 'value1',
                    'param2' => 'value2',
                ),
            )
        );
    }

}
