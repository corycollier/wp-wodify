<?php
/**
 * Class to test the WpWodify\Exception object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Exception object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the ability to create an exception
     */
    public function test_constructor()
    {
        $exception = new Exception;
        $this->assertInstanceOf('\WpWodify\Exception', $exception);
    }

}
