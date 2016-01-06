<?php
/**
 * Overlord Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Overlord
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Overlord Class.
 *
 * This class serves to oversee all aspects of the implementation. This is the
 * glue for all of the classes.
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Overlord
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Overlord {
    /**
     * Singleton property instance.
     *
     * @var WpWodify\Overlord
     */
    protected static $instance;

    /**
     * Instance of the loader.
     *
     * @var WpWodify\Loader
     */
    protected $loader;

    /**
     * Privatizing the constructor, to enforce the singleton pattern
     */
    private function __construct() {

    }

    /**
     * Gets the singleton instance of self.
     *
     * @return WpWodify\Overloard Returns self::$instance
     */
    public static function get_instance() {
        if (! self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Getter for the loader instance.
     *
     * @return WpWodify\Loader The loader instance.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Setter for the loader instance.
     *
     * @param WpWodify\Loader $loader The loader instance
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function set_loader( $loader ) {
        $this->loader = $loader;
        return $this;
    }

    /**
     * Defines which class/callbacks are used for admin hook implementations.
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function define_admin_hooks() {
        $is_admin = \is_admin();

        if ( true == $is_admin ) {

        }

        return $this;
    }

    /**
     * Defines which class/callbacks are used for public hook implementations.
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function define_public_hooks() {

        return $this;
    }

    /**
     * Registers all of the needed settings for the plugin.
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function register_settings() {
        \register_setting( 'wp-wodify-settings-group', 'wp-wodify-api-key' );
        \register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_classes' );
        \register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_coaches' );
        \register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_locations' );
        \register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_programs' );

        return $this;
    }

    /**
     * Main entry point.
     *
     * @return WpWodify\Overlord Return $this, for object-chaining.
     */
    public function run() {
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->register_settings();

        return $this;
    }

    /**
     * Defines menu entries for the admin section
     */
    public function define_menu_hooks() {
        $pages = new Pages;
        $pages->set_template(new Template);
        add_options_page(
            'WP Wodify Options',
            'WP Wodify',
            'manage_options',
            'wp-wodify-administer',
            array($pages, 'admin_settings')
        );
    }
}

// add the menu for the admin page
// add_action( 'admin_menu', 'wp_wodify_admin_menu' );
// add_action( 'admin_init', 'wp_wodify_admin_init' );


// INIT CODE

//   add_settings_section( 'section-one'
//     , 'Section One'
//     , 'wp_wodify_admin_section_callback'
//     , 'wp-wodify-administer'
//   );

//   add_settings_field( 'wp-wodify-api-key'
//     , 'Api Key'
//     , 'wp_wodify_admin_api_key_field_callback'
//     , 'wp-wodify-administer'
//     , 'section-one'
//   );

//   $types = array('coaches', 'classes', 'locations', 'programs');
//   foreach ($types as $type) {
//     add_action( 'admin_post_wp_wodify_' . $type . '_sync',   'wp_wodify_get_api_' . $type );
//   }

//   add_action( 'admin_enqueue_scripts', 'wp_wodify_admin_scripts' );
// }
//

// MENU CODE
//
// function wp_wodify_admin_menu() {
//   add_options_page(
//     'WP Wodify Options',
//     'WP Wodify',
//     'manage_options',
//     'wp-wodify-administer',
//     'wp_wodify_admin_options'
//   );
// }