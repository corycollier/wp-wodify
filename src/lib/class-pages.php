<?php
/**
 * Pages Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Pages
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Pages Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Pages
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Pages {
    /**
     * Holds an instance of a WpWodify\Template class.
     *
     * @var WpWodify\Template
     */
    protected $template;

    /**
     * Setter for the $template var.
     *
     * @param WpWodify\Template $template The Template instance.
     *
     * @return WpWodify\Pages Returns $this, for object-chaining.
     */
    public function set_template($template) {
        $this->template = $template;
        return $this;
    }

    /**
     * Getter for the $template property.
     *
     * @return WpWodify\Template The template instance.
     */
    public function get_template() {
        return $this->template;
    }

    /**
     * Page to display admin settings
     */
    public function admin_settings() {
        $template = $this->get_template();
        $template->set_script('admin-settings-template.php');
        $template->render();
    }

}