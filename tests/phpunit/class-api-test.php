<?php
/**
 * Class to test the WpWodify\Api object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

use WpWodify\Api as Api;

/**
 * Class to test the WpWodify\Api object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the WpWodify\Api::get_api_key method.
     */
    public function test_get_api_key()
    {
        $expected = 'the expected value';
        $sut = new Api;

        $property = new \ReflectionProperty('\WpWodify\Api', 'api_key');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);

        $result = $sut->get_api_key();
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests the WpWodify\Api::set_api_key method.
     */
    public function test_set_api_key()
    {
        $expected = 'the expected value';
        $sut = new Api;

        $sut->set_api_key($expected);

        $property = new \ReflectionProperty('\WpWodify\Api', 'api_key');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests WpWodify\Api::get_api_uri.
     *
     * @dataProvider provide_get_api_uri
     */
    public function test_get_api_uri($expected, $name, $exception = false)
    {
        if ($exception) {
            $this->setExpectedException('\WpWodify\Exception');
        }
        $sut = new Api;
        $result = $sut->get_api_uri($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for test_get_api_uri.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get_api_uri()
    {
        return array(
            array(
                'expected' => 'http://app.wodify.com/API/Classes_v1.aspx',
                'name'     => 'classes',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/Coaches_v1.aspx',
                'name'     => 'coaches',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/Leaderboard_v1.aspx',
                'name'     => 'leaderboards',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/LeaderboardResults_v1.aspx',
                'name'     => 'results',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/Locations_v1.aspx',
                'name'     => 'locations',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/Programs_v1.aspx',
                'name'     => 'programs',
            ),
            array(
                'expected' => 'http://app.wodify.com/API/Whiteboard_v1.aspx',
                'name'     => 'whitebaord',
            ),
            array(
                'expected' => 'does not matter',
                'name'     => 'bad-stuff',
                'exception' => true,
            ),
        );
    }

    /**
     * Tests WpWodify\Api::get
     *
     * @dataProvider provide_get
     */
    public function test_get($expected, $apiName, $params)
    {
        $sut = $this->getMockBuilder('\WpWodify\Api')
            ->setMethods(array('get_api_key', 'get_api_uri'))
            ->getMock();

        \Patchwork\replace('esc_attr', function($string) {
            return $string;
        });

        \Patchwork\replace('wp_remote_get', function($uri) use ($expected) {
            return $expected;
        });

        $sut->expects($this->once())
            ->method('get_api_key')
            ->will($this->returnValue(''));

        $sut->expects($this->once())
            ->method('get_api_uri')
            ->will($this->returnValue(''));

        $result = $sut->get($apiName, $params);
        $this->assertEquals($expected, $result);

    }

    /**
     * Data provider for test_get.
     *
     * @return array An array of data to use for testing.
     */
    public function provide_get()
    {
        return array(
            array(
                'expected' => 'the expected value',
                'apiName'  => 'Some Api',
                'params'   => array(

                ),
            ),
        );
    }
}
