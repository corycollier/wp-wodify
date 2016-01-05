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

    public function test_add_action()
    {
        $sut = new Loader;
        $expected = array(

        );

        $property = new \ReflectionProperty('\WpWodify\Loader', 'actions');
        $property->setAccessible(true);
        $property->getValue($sut);

    }
}
