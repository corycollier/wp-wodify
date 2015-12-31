<?php
/**
 * Loader Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Loader
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Loader Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Loader
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Loader {

    /**
     * A list of actions to add.
     *
     * @var array
     */
    protected $actions;

    /**
     * A list of filters to add.
     *
     * @var array
     */
    protected $filters;

    /**
     * Adds an action to the list of actions.
     *
     * @param string $hook The name of the hook to implement
     * @param mixed $component The class instance which a callback will be called on.
     * @param string $callback Name of the method to call on the component.
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function add_action( $hook, $component, $callback ) {
        $this->actions[] = $this->componentify( $hook, $component, $callback );
        return $this;
    }

    /**
     * Adds an filter to the list of filters.
     *
     * @param string $hook The name of the hook to implement
     * @param mixed $component The class instance which a callback will be called on.
     * @param string $callback Name of the method to call on the component.
     *
     * @return WpWodify\Overlord Returns $this, for object-chaining.
     */
    public function add_filter( $hook, $component, $callback ) {
        $this->actions[] = $this->componentify( $hook, $component, $callback );
        return $this;
    }

    /**
     * Takes string arguments, and turns them into an standardized array.
     *
     * @param string $hook the name of a wordpress hook
     * @param mixed $component A class instance.
     * @param string $callback The name of a method to call on the component.
     *
     * @return array The resulting array.
     */
    protected function componentify( $hook, $component, $callback ) {
        $result = array(
            'hook'          => $hook,
            'function'      => array( $component, $callback ),
            'priority'      => 10,
            'accepted_args' => 1,
        );
        return $result;
    }

}