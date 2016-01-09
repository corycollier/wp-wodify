<?php
/**
 * Settings Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Settings
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Settings Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Settings
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Settings {
    /**
     * Stores the name of the section.
     * @var string
     */
    protected $name;

    /**
     * Stores the plugin specific prefix for names in the settings.
     * @var string
     */
    protected $prefix = 'wp-wodify-';

    /**
     * Constructor.
     *
     * @param string $name The name of the settings instance.
     *
     * @param string $slug The uri slug for the settings instance.
     */
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Adds a section to the settings instance.
     *
     * @param mixed $callback The callback for the section.
     *
     * @return WpWodify\Settings Returns $this, for object-chaining.
     */
    public function add_section($callback) {
        $name  = $this->name;
        $human = $this->humanize($name);
        $slug  = $this->get_slug();

        \add_settings_section($name, $human, $callback, $slug);
        return $this;
    }

    /**
     * Adds a field to the settings section.
     *
     * @param string $name The name of the field.
     * @param mixed $callback The callback for dispalying the field.
     *
     * @return WpWodify\Settings Returns $this, for object-chaining.
     */
    public function add_field($name, $callback) {
        $title   = $this->humanize($name);
        $section = $this->name;
        $name    = $this->prefix . $name;
        $slug    = $this->get_slug();

        \add_settings_field($name, $title, $callback, $slug, $section);
        return $this;
    }

    /**
     * Register's a setting.
     *
     * @param string $name The name of the setting.
     * @param string $group The group that the setting belongs to.
     *
     * @return WpWodify\Settings Returns $this, for object-chaining.
     */
    public function register($name, $group) {
        \register_setting($group, $name);
        return $this;
    }

    /**
     * Takes a machine string, and makes it more human friendly.
     *
     * @param string $string The machine string.
     *
     * @return string The human string.
     */
    protected function humanize($string) {
        $string = trim(strtr($string, array(
            '-' => ' ',
            '_' => ' ',
        )));
        $string = ucwords($string);
        return $string;
    }

    /**
     * Takes a human string, and makes it more machine friendly.
     *
     * @param string $string The input string.
     *
     * @return string The machine string.
     */
    protected function machinify($string) {
        $string = strtr(trim($string), array(
            ' ' => '-',
            ',' => '',
        ));
        $string = strtolower($string);
        return $string;
    }

    /**
     * Gets the slug for the settings section.
     *
     * @return string The unique slug for the settings section
     */
    protected function get_slug() {
        return $this->prefix . $this->name . '-settings';
    }
}
