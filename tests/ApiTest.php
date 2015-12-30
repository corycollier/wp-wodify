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
     * Tests the WpWodify\Api::getApiKey method.
     */
    public function testGetApiKey()
    {
        $expected = 'the expected value';
        $sut = new Api;

        $property = new \ReflectionProperty('\WpWodify\Api', 'apiKey');
        $property->setAccessible(true);
        $property->setValue($sut, $expected);

        $result = $sut->getApiKey();
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests the WpWodify\Api::setApiKey method.
     */
    public function testSetApiKey()
    {
        $expected = 'the expected value';
        $sut = new Api;

        $sut->setApiKey($expected);

        $property = new \ReflectionProperty('\WpWodify\Api', 'apiKey');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests WpWodify\Api::getApiUri.
     *
     * @dataProvider provideGetApiUri
     */
    public function testGetApiUri($expected, $name, $exception = false)
    {
        if ($exception) {
            $this->setExpectedException('\WpWodify\Exception');
        }
        $sut = new Api;
        $result = $sut->getApiUri($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetApiUri.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetApiUri()
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
     * @dataProvider provideGet
     */
    public function testGet($expected, $apiName, $params)
    {
        $sut = $this->getMockBuilder('\WpWodify\Api')
            ->setMethods(array('getApiKey', 'getApiUri'))
            ->getMock();

        \Patchwork\replace('esc_attr', function($string) {
            return $string;
        });

        \Patchwork\replace('wp_remote_get', function($uri) use ($expected) {
            return $expected;
        });

        $sut->expects($this->once())
            ->method('getApiKey')
            ->will($this->returnValue(''));

        $sut->expects($this->once())
            ->method('getApiUri')
            ->will($this->returnValue(''));

        $result = $sut->get($apiName, $params);
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
                'expected' => 'the expected value',
                'apiName'  => 'Some Api',
                'params'   => array(

                ),
            ),
        );
    }
}
