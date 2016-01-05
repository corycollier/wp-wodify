<?php
/**
 * Class to test the WpWodify\Installer object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Class to test the WpWodify\Installer object
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InstallerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the ability to install the plugin
     */
    public function test_install()
    {
        $sut = new Installer;
        $sut->install();
    }

    /**
     * Tests the ability to uninstall the plugin
     */
    public function test_uninstall()
    {
        $sut = new Installer;
        $sut->uninstall();

        define('WP_UNINSTALL_PLUGIN', '');
        $sut->uninstall();
    }
}
