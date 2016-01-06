<?php
/**
 * Template Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Template
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Template Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Template
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Template {

    /**
     * A list of variables to store for the script.
     *
     * @var array
     */
    protected $vars;

    /**
     * The script to use for rendering.
     *
     * @var string
     */
    protected $script;

    /**
     * Setter for the script var.
     *
     * @param string $name The name of the script var.
     *
     * @return WpWodify\Template Returns $this, for object-chaining.
     */
    public function set_script( $name ) {
        $this->script = $name;
        return $this;
    }

    /**
     * Getter for the script var
     *
     * @return string The name of the script var.
     */
    public function get_script() {
        return $this->script;
    }

    /**
     * Run the script.
     *
     * @return WpWodify\Template Returns $this, for object-chaining.
     */
    public function render() {
        $script = $this->get_script();
        require plugin_dir_path( __FILE__ ) . $script;
        return $this;
    }

    /**
     * Assigns a variable to the vars attribute, for use in a script.
     *
     * @param string $name  Name of the variable.
     * @param mixed $value Value of the variable.
     *
     * @return WpWodify\Template Returns $this, for object-chaining.
     */
    public function set( $name, $value = null ) {
        $this->vars[ $name ] = $value;
        return $this;
    }

}