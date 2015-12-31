<?php
/**
 * Installer Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Installer
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Installer Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Installer
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Installer {

    /**
     * Installs the plugin
     * @return [type] [description]
     */
    public function install() {
        // really not needed here, but this is always a good housekeeping measure
        flush_rewrite_rules();
    }

    /**
     * Uninstalls the plugin
     * @return [type] [description]
     */
    public function uninstall() {
        if (! defined('WP_UNINSTALL_PLUGIN')) {
          return;
        }

        // really not needed here, but this is always a good housekeeping measure
        flush_rewrite_rules();
    }
}