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
     * A list of variables to store for the template.
     *
     * @var array
     */
    protected $vars;

    /**
     * The template to use for rendering.
     *
     * @var string
     */
    protected $template;

    /**
     * Setter for the template var.
     *
     * @param string $name The name of the template var.
     *
     * @return WpWodify\Template Returns $this, for object-chaining.
     */
    public function set_template( $name ) {
        $this->template = $name;
        return $this;
    }

    /**
     * Getter for the template var
     *
     * @return string The name of the template var.
     */
    public function get_template() {
        return $this->template;
    }

    /**
     * Run the template.
     *
     * @return WpWodify\Template Returns $this, for object-chaining.
     */
    public function render() {
        $template = $this->get_template();
        require plugin_dir_path( __FILE__ ) . $template;
        return $this;
    }

    /**
     * Assigns a variable to the vars attribute, for use in a template.
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